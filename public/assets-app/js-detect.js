if (document.documentElement.className.match(/no-js/)) {
  document.documentElement.className =
    document.documentElement.className.replace(/(?:^|\s)no-js(?!\S)/g , 'has-js');
}
else {
  document.documentElement.className += ' has-js';
}
