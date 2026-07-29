(function () {
  'use strict';

  function fallbackCopy(text) {
    var textarea = document.createElement('textarea');
    textarea.value = text;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'fixed';
    textarea.style.opacity = '0';
    document.body.appendChild(textarea);
    textarea.select();

    var copied = document.execCommand('copy');
    document.body.removeChild(textarea);

    return copied ? Promise.resolve() : Promise.reject(new Error('copy failed'));
  }

  function copyText(text) {
    if (navigator.clipboard && window.isSecureContext) {
      return navigator.clipboard.writeText(text);
    }

    return fallbackCopy(text);
  }

  document.addEventListener('click', function (event) {
    var button = event.target.closest('.daifuk-prompt-copy-button');
    if (!button) {
      return;
    }

    var wrapper = button.closest('.daifuk-prompt-copy');
    var code = wrapper ? wrapper.querySelector('code') : null;
    if (!code) {
      return;
    }

    copyText(code.textContent).then(function () {
      var originalLabel = button.textContent;
      button.textContent = 'コピーしました';
      button.classList.add('is-copied');
      window.setTimeout(function () {
        button.textContent = originalLabel;
        button.classList.remove('is-copied');
      }, 2000);
    }).catch(function () {
      button.textContent = 'コピーできませんでした';
      window.setTimeout(function () {
        button.textContent = 'コピー';
      }, 2000);
    });
  });
}());
