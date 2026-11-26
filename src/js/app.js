import addCustomEvent from '@inc2734/add-custom-event';
import Cookies from 'js-cookie';

const onDOMContentLoaded = () => {
  const wrapper = document.getElementById('footer-sticky-nav');
  if (! wrapper) {
    return;
  }

  const scrollTop = () => {
    return document.documentElement.scrollTop || document.body.scrollTop;
  };

  const updateVisibility = () => {
    const shouldShow = scrollTop() >= snow_monkey_footer_cta.delay;
    const ariaHidden = String(! shouldShow);
    if (wrapper.getAttribute('aria-hidden') === ariaHidden) {
      return;
    }

    wrapper.setAttribute('aria-hidden', ariaHidden);
    addCustomEvent(wrapper, 'initFooterStickyNav');
  };

  updateVisibility();
  window.addEventListener('scroll', updateVisibility, false);

  const setHiddenCookie = () => {
    const getPath = () => {
      if (typeof snow_monkey.home_url === 'undefined') {
        return '';
      }
      const dummy = document.createElement('a');
      dummy.href  = snow_monkey.home_url;
      const pathname = dummy.pathname + '/';
      return pathname.replace('//', '/');
    };

    Cookies.set(
      'snow-monkey-footer-cta-hidden',
      1,
      {
        expires: 1,
        path: getPath(),
      }
    );
  };

  const onCloseBtnClick = () => {
    wrapper.parentNode.removeChild(wrapper);
    document.body.style['marginBottom'] = '';
    setHiddenCookie();
    window.removeEventListener('scroll', updateVisibility, false);
  };

  const closeBtn = wrapper.querySelector('.p-footer-cta__close-btn');
  if (closeBtn) {
    closeBtn.addEventListener('click', onCloseBtnClick, false);
  }
};

document.addEventListener( 'DOMContentLoaded', onDOMContentLoaded, false);
