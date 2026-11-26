const assert = require( 'node:assert/strict' );
const { readFileSync } = require( 'node:fs' );
const { resolve } = require( 'node:path' );
const { test } = require( 'node:test' );
const { JSDOM } = require( 'jsdom' );

const bundle = readFileSync( resolve( __dirname, '../../dist/js/app.js' ), 'utf8' );

function render( t, { delay = 300, initialScroll = 0, content = '<div id="footer-sticky-nav" aria-hidden="true"><button class="p-footer-cta__close-btn">Close</button></div>' } = {} ) {
	const dom = new JSDOM( `<body style="margin-bottom: 80px">${ content }</body>`, {
		runScripts: 'outside-only',
		url: 'https://example.org/subdir/page',
	} );
	t.after( () => dom.window.close() );
	const { window } = dom;
	window.snow_monkey_footer_cta = { delay };
	window.snow_monkey = { home_url: 'https://example.org/subdir/' };
	window.document.documentElement.scrollTop = initialScroll;
	window.eval( bundle );
	window.document.dispatchEvent( new window.Event( 'DOMContentLoaded' ) );
	const scroll = ( top ) => {
		window.document.documentElement.scrollTop = top;
		window.dispatchEvent( new window.Event( 'scroll' ) );
	};
	return { dom, window, scroll };
}

test( 'shows and hides the CTA at the configured scroll threshold', ( t ) => {
	const { window, scroll } = render( t );
	const wrapper = window.document.getElementById( 'footer-sticky-nav' );
	let events = 0;
	wrapper.addEventListener( 'initFooterStickyNav', () => events++ );
	scroll( 299 );
	assert.equal( wrapper.getAttribute( 'aria-hidden' ), 'true' );
	assert.equal( events, 0 );
	scroll( 300 );
	assert.equal( wrapper.getAttribute( 'aria-hidden' ), 'false' );
	assert.equal( events, 1 );
	scroll( 400 );
	assert.equal( events, 1 );
	scroll( 0 );
	assert.equal( wrapper.getAttribute( 'aria-hidden' ), 'true' );
	assert.equal( events, 2 );
} );

test( 'shows the CTA at 0px without a scroll event', ( t ) => {
	const { window } = render( t, { delay: '0' } );
	assert.equal( window.document.getElementById( 'footer-sticky-nav' ).getAttribute( 'aria-hidden' ), 'false' );
} );

test( 'uses the scroll position at initialization', ( t ) => {
	const { window } = render( t, { initialScroll: 300 } );
	assert.equal( window.document.getElementById( 'footer-sticky-nav' ).getAttribute( 'aria-hidden' ), 'false' );
} );

test( 'closing the CTA clears spacing, saves a cookie and removes the scroll handler', ( t ) => {
	const { dom, window, scroll } = render( t );
	const wrapper = window.document.getElementById( 'footer-sticky-nav' );
	window.document.querySelector( 'button' ).click();
	assert.equal( wrapper.isConnected, false );
	assert.equal( window.document.body.style.marginBottom, '' );
	const cookies = dom.cookieJar.getCookiesSync( 'https://example.org/subdir/' );
	const cookie = cookies.find( ( item ) => item.key === 'snow-monkey-footer-cta-hidden' );
	assert.equal( cookie.value, '1' );
	assert.equal( cookie.path, '/subdir/' );
	assert.ok( cookie.expires instanceof Date );
	scroll( 500 );
	assert.equal( wrapper.getAttribute( 'aria-hidden' ), 'true' );
} );

test( 'handles a page without a CTA or without a close button', ( t ) => {
	const empty = render( t, { content: '<main>Content</main>' } );
	assert.doesNotThrow( () => empty.scroll( 400 ) );
	const { window, scroll } = render( t, { content: '<div id="footer-sticky-nav" aria-hidden="true"></div>' } );
	scroll( 300 );
	assert.equal( window.document.getElementById( 'footer-sticky-nav' ).getAttribute( 'aria-hidden' ), 'false' );
} );
