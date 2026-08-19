/* ===========================================================
   browme corporate site — main.js
   All page behavior in one file. Each block is a self-contained
   IIFE guarded by its own element checks, so this single script
   works unmodified on both index.html and recruit.html — a
   block simply no-ops on a page that lacks its markup.
   =========================================================== */

/* ---------- Opening — first-load intro overlay ---------- */
(function () {
  'use strict';

  var overlay = document.querySelector('.opening');
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // No overlay on this page, motion is disabled, or GSAP failed to load —
  // CSS alone already covers every one of those cases (resting look /
  // display:none / the safety-net fade), nothing more for JS to do.
  // NOTE: replays on every load right now (no "seen this session" skip)
  // while the intro is still being tuned — reintroduce a sessionStorage
  // check here if/when it should only play once again.
  if (!overlay || reduceMotion || typeof gsap === 'undefined') return;

  // GSAP is taking over the reveal — drop the CSS safety-net animation
  // so it can't fight (or double-fire) alongside the timeline below.
  overlay.style.animation = 'none';

  var browGroup = overlay.querySelector('.opening__brow-strokes');
  var strokes = overlay.querySelectorAll('.opening__brow-strokes path');
  var logo = overlay.querySelector('.opening__logo');
  var sub = overlay.querySelector('.opening__sub');

  gsap.set(strokes, {
    strokeDasharray: function (i, target) {
      return target.getTotalLength();
    },
    strokeDashoffset: function (i, target) {
      return target.getTotalLength();
    }
  });
  gsap.set([logo, sub], { autoAlpha: 0, y: 10 });

  gsap
    .timeline({
      defaults: { ease: 'power2.out' },
      onComplete: function () {
        overlay.style.display = 'none';
      }
    })
    // Each brow hair draws in root-to-tip, left to right — the brow
    // fills in stroke by stroke, taking shape like it's being groomed.
    .to(strokes, { strokeDashoffset: 0, duration: 0.45, stagger: 0.04 }, 0)
    // Once it's fully filled in, a soft bloom settles it into place —
    // the finishing "beautiful" touch.
    .to(browGroup, { scale: 1.06, transformOrigin: '50% 70%', duration: 0.25, ease: 'power2.out' }, 0.95)
    .to(browGroup, { scale: 1, duration: 0.4, ease: 'power2.inOut' }, 1.2)
    // Logo and sub-label settle in, overlapping the brow's finish.
    .to(logo, { autoAlpha: 1, y: 0, duration: 0.65 }, 0.65)
    .to(sub, { autoAlpha: 1, y: 0, duration: 0.65 }, 0.85)
    // A brief hold (total sequence now runs 3s), then the whole overlay
    // dissolves to reveal the page.
    .to(overlay, { autoAlpha: 0, duration: 0.65 }, 2.35);
})();

/* ---------- Scroll / entrance animations ---------- */
(function () {
  'use strict';

  if (typeof gsap === 'undefined') return;
  if (typeof ScrollTrigger !== 'undefined') gsap.registerPlugin(ScrollTrigger);

  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (reduceMotion || typeof ScrollTrigger === 'undefined') return;

  var EASE = 'power2.out';

  /**
   * Fade + slide-up reveal for one or more elements inside a container,
   * once the container scrolls into view. Mirrors the "控えめなフェードイン
   * ／スライド" motion spec — no large movement, no bounce.
   */
  function reveal(containerSelector, itemSelector, opts) {
    opts = opts || {};
    document.querySelectorAll(containerSelector).forEach(function (container) {
      var items = itemSelector ? container.querySelectorAll(itemSelector) : [container];
      if (!items.length) return;

      gsap.set(items, { autoAlpha: 0, y: opts.y || 26 });

      ScrollTrigger.create({
        trigger: container,
        start: opts.start || 'top 75%',
        once: true,
        onEnter: function () {
          gsap.to(items, {
            autoAlpha: 1,
            y: 0,
            duration: opts.duration || 0.95,
            ease: EASE,
            stagger: opts.stagger || 0.1
          });
        }
      });
    });
  }

  // ---------------------------------------------------------------
  // Header — subtle shadow once the page has scrolled past the hero
  // ---------------------------------------------------------------
  var header = document.querySelector('.site-header');
  if (header) {
    ScrollTrigger.create({
      start: 'top -80',
      end: 99999,
      toggleClass: { targets: header, className: 'site-header--scrolled' }
    });
  }

  // ---------------------------------------------------------------
  // Hero — staggered entrance on load + slow "Ken Burns" photo drift
  // ---------------------------------------------------------------
  var heroLabel = document.querySelector('.hero__label, .recruit-hero__label');
  var heroTitle = document.querySelector('.hero__title, .recruit-hero__title');
  var heroLead = document.querySelector('.hero__lead, .recruit-hero__lead');
  var heroEntranceTargets = [heroLabel, heroTitle, heroLead].filter(Boolean);

  if (heroEntranceTargets.length) {
    // If the opening intro is about to play, time the hero's own reveal
    // to land as that overlay fades away instead of finishing invisibly
    // underneath it.
    var openingWillPlay = !!document.querySelector('.opening');
    var heroEntranceDelay = openingWillPlay ? 2.35 : 0.2;

    gsap.set(heroEntranceTargets, { autoAlpha: 0, y: 22 });
    gsap.to(heroEntranceTargets, {
      autoAlpha: 1,
      y: 0,
      duration: 0.9,
      ease: EASE,
      stagger: 0.15,
      delay: heroEntranceDelay
    });
  }

  var heroMedia = document.querySelector(
    '.hero__media .img-placeholder, .hero__media .img-wrapper, .hero__media > img, ' +
      '.recruit-hero__media .img-placeholder, .recruit-hero__media .img-wrapper, .recruit-hero__media > img'
  );
  if (heroMedia) {
    gsap.fromTo(
      heroMedia,
      { scale: 1.08 },
      { scale: 1, duration: 6, ease: 'sine.out' }
    );
  }

  // ---------------------------------------------------------------
  // Section headings — flanking rules draw in from the center,
  // label text fades up just after.
  // ---------------------------------------------------------------
  document.querySelectorAll('.section-heading').forEach(function (heading) {
    var rules = heading.querySelectorAll('.section-heading__rule');
    var labels = heading.querySelector('.section-heading__labels');
    if (!rules.length && !labels) return;

    gsap.set(rules, { scaleX: 0 });
    if (labels) gsap.set(labels, { autoAlpha: 0, y: 16 });

    ScrollTrigger.create({
      trigger: heading,
      start: 'top 75%',
      once: true,
      onEnter: function () {
        gsap.to(rules, { scaleX: 1, duration: 0.95, ease: EASE, stagger: 0.05 });
        if (labels) {
          gsap.to(labels, { autoAlpha: 1, y: 0, duration: 0.85, ease: EASE, delay: 0.15 });
        }
      }
    });
  });

  // ---------------------------------------------------------------
  // Section leads / standalone copy blocks
  // ---------------------------------------------------------------
  reveal('.section-lead', null, { y: 18 });
  reveal('.about-copy', null);
  reveal('.about-media', null, { start: 'top 78%' });
  reveal('.recruit-teaser', '.recruit-teaser__media, .recruit-teaser__copy', { stagger: 0.15 });
  reveal('.message-copy', ':scope > h2, :scope > p');
  reveal('.job-grid', '.job-copy, .job-flow-card', { stagger: 0.15 });
  reveal('.day-grid', '.day-timeline, .day-photos', { stagger: 0.15 });
  reveal('.position-card', null);
  reveal('.entry-cta', '.entry-cta__label, .entry-cta__title, .entry-cta__lead, .entry-cta__actions', {
    stagger: 0.1
  });

  // ---------------------------------------------------------------
  // Card grids / lists — gentle staggered reveal
  // ---------------------------------------------------------------
  reveal('.card-grid', '.card', { stagger: 0.1 });
  reveal('.store-grid', '.store-card', { stagger: 0.1 });
  reveal('.persona-grid', '.persona-card', { stagger: 0.1 });
  reveal('.voices-grid', '.voice-card', { stagger: 0.12 });
  reveal('.numbers-grid', '.number-tile', { stagger: 0.08 });
  reveal('.faq-list', '.faq-item', { stagger: 0.08 });
  reveal('.numbered-list', '.numbered-row', { stagger: 0.1, y: 18 });
  reveal('.news-list', '.news-item', { stagger: 0.08, y: 18 });

  // ---------------------------------------------------------------
  // Photo placeholders — soft scale-in reveal as they enter view
  // (skips the hero, which has its own slow Ken Burns treatment)
  // ---------------------------------------------------------------
  document.querySelectorAll('.img-placeholder').forEach(function (img) {
    if (img.closest('.hero__media') || img.closest('.recruit-hero__media')) return;

    gsap.set(img, { scale: 1.12, autoAlpha: 0.5 });
    ScrollTrigger.create({
      trigger: img,
      start: 'top 80%',
      once: true,
      onEnter: function () {
        gsap.to(img, { scale: 1, autoAlpha: 1, duration: 1.3, ease: EASE });
      }
    });
  });

  // ---------------------------------------------------------------
  // Numbers section — count up from 0 to the target value
  // ---------------------------------------------------------------
  document.querySelectorAll('[data-count-to]').forEach(function (el) {
    var target = parseFloat(el.getAttribute('data-count-to'));
    var decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
    var counter = { value: 0 };

    ScrollTrigger.create({
      trigger: el,
      start: 'top 78%',
      once: true,
      onEnter: function () {
        gsap.to(counter, {
          value: target,
          duration: 1.8,
          ease: 'power1.out',
          onUpdate: function () {
            el.textContent = counter.value.toFixed(decimals);
          }
        });
      }
    });
  });
})();

/* ---------- Mobile nav toggle ---------- */
(function () {
  'use strict';

  var toggle = document.querySelector('[data-menu-toggle]');
  var mobileNav = document.querySelector('[data-mobile-nav]');

  if (!toggle || !mobileNav) return;

  function closeMenu() {
    mobileNav.hidden = true;
    toggle.setAttribute('aria-expanded', 'false');
  }

  function openMenu() {
    mobileNav.hidden = false;
    toggle.setAttribute('aria-expanded', 'true');
  }

  toggle.addEventListener('click', function () {
    var isOpen = toggle.getAttribute('aria-expanded') === 'true';
    if (isOpen) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  mobileNav.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', closeMenu);
  });
})();

/* Contact form submission is handled by the Contact Form 7 plugin
   (real AJAX submit + its own success/error messaging) — no demo
   handler needed here in the WordPress build. */

/* ---------- Recruit — staff voices modal ---------- */
(function () {
  'use strict';

  var overlay = document.querySelector('[data-voice-modal]');
  if (!overlay) return;

  var modal = overlay.querySelector('[data-voice-modal-dialog]');
  var closeBtn = overlay.querySelector('[data-voice-modal-close]');
  var nameEl = overlay.querySelector('[data-voice-modal-name]');
  var roleEl = overlay.querySelector('[data-voice-modal-role]');
  var titleEl = overlay.querySelector('[data-voice-modal-title]');
  var bodyEl = overlay.querySelector('[data-voice-modal-body]');
  var avatarEl = overlay.querySelector('[data-voice-modal-avatar]');
  var lastFocused = null;
  var hasGsap = typeof gsap !== 'undefined';

  function openModal(card) {
    nameEl.textContent = card.getAttribute('data-name');
    roleEl.textContent = card.getAttribute('data-role');
    titleEl.textContent = card.getAttribute('data-title');
    bodyEl.textContent = card.getAttribute('data-body');
    avatarEl.src = card.getAttribute('data-avatar-src');
    avatarEl.alt = card.getAttribute('data-avatar-alt') || '';

    lastFocused = card;
    overlay.hidden = false;
    document.body.style.overflow = 'hidden';

    if (hasGsap) {
      gsap.fromTo(overlay, { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.3, ease: 'power2.out' });
      gsap.fromTo(
        modal,
        { autoAlpha: 0, y: 24, scale: 0.97 },
        { autoAlpha: 1, y: 0, scale: 1, duration: 0.4, ease: 'power2.out', delay: 0.05 }
      );
    }

    closeBtn.focus();
  }

  function closeModal() {
    if (hasGsap) {
      gsap.to(modal, { autoAlpha: 0, y: 16, scale: 0.97, duration: 0.25, ease: 'power1.in' });
      gsap.to(overlay, {
        autoAlpha: 0,
        duration: 0.3,
        ease: 'power1.in',
        delay: 0.05,
        onComplete: function () {
          overlay.hidden = true;
          document.body.style.overflow = '';
          if (lastFocused) lastFocused.focus();
        }
      });
    } else {
      overlay.hidden = true;
      document.body.style.overflow = '';
      if (lastFocused) lastFocused.focus();
    }
  }

  document.querySelectorAll('[data-voice-card]').forEach(function (card) {
    card.addEventListener('click', function () {
      openModal(card);
    });
    card.addEventListener('keydown', function (event) {
      if (event.key === 'Enter' || event.key === ' ' || event.key === 'Spacebar') {
        event.preventDefault();
        openModal(card);
      }
    });
  });

  overlay.addEventListener('click', closeModal);
  modal.addEventListener('click', function (event) {
    event.stopPropagation();
  });
  closeBtn.addEventListener('click', closeModal);

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && !overlay.hidden) closeModal();
  });
})();
