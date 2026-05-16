/**
 * Lantern — theme interactions.
 * Mobile nav toggle, intersection-observer reveals, smooth focus.
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {

        // Mobile nav toggle.
        var burger = document.querySelector('.lantern-burger');
        var nav = document.getElementById('lantern-primary-nav');
        if (burger && nav) {
            burger.addEventListener('click', function () {
                var open = nav.classList.toggle('is-open');
                burger.setAttribute('aria-expanded', open ? 'true' : 'false');
                document.documentElement.style.overflow = open ? 'hidden' : '';
            });
            // Close on resize up to desktop.
            window.addEventListener('resize', function () {
                if (window.innerWidth > 960 && nav.classList.contains('is-open')) {
                    nav.classList.remove('is-open');
                    burger.setAttribute('aria-expanded', 'false');
                    document.documentElement.style.overflow = '';
                }
            });
        }

        // Intersection-observer reveals.
        var reveals = document.querySelectorAll('.lantern-reveal');
        if (reveals.length && 'IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry, i) {
                    if (entry.isIntersecting) {
                        // Slight stagger for adjacent siblings.
                        entry.target.style.transitionDelay = (i % 4) * 80 + 'ms';
                        entry.target.classList.add('is-in');
                        io.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -10% 0px' });
            reveals.forEach(function (el) { io.observe(el); });
        } else {
            reveals.forEach(function (el) { el.classList.add('is-in'); });
        }

        // Subtle parallax on the hero numerals.
        var numerals = document.querySelector('.lantern-hero__numerals');
        if (numerals && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            var rafId = null;
            window.addEventListener('scroll', function () {
                if (rafId) { return; }
                rafId = window.requestAnimationFrame(function () {
                    var y = window.scrollY;
                    numerals.style.transform = 'translate3d(0,' + (y * -0.08).toFixed(2) + 'px,0)';
                    rafId = null;
                });
            }, { passive: true });
        }
    });
})();
