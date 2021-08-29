require('./bootstrap');
import Editor from '@toast-ui/editor'
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

let editors = new Map();

window.createToastEditor = function createToastEditor(id) {
  const editor = new Editor({
    el: document.getElementById(id),
    height: '400px',
    initialEditType: 'markdown',
    usageStatistics: false
  });

  editors[id] = editor;
  return editor;
};

window.syncEditorContents = function syncEditorContents(id, dst) {
  $(`#${dst}`).val(editors[id].getMarkdown());
  document.getElementById(dst).dispatchEvent(new Event('input'));
};

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

