require('./bootstrap');
import Editor from '@toast-ui/editor'
import 'codemirror/lib/codemirror.css';
import '@toast-ui/editor/dist/toastui-editor.css';

let editors = new Map();

window.createToastEditor = function createToastEditor(id, contents = '') {
  const editor = new Editor({
    el: document.getElementById(id),
    height: '500px',
    initialEditType: 'markdown',
    usageStatistics: false
    /*
    hooks: {
      addImageBlobHook: (blob, callback) => {
        console.log(blob);
          alert('hello world!');
          const uploadedImageURL = uploadImage(blob);
          callback(uploadedImageURL, "alt text");
          return false;
      }
    }
    */
  });

  editor.setMarkdown(contents);
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

