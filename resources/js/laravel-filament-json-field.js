
import CodeMirror from "codemirror/lib/codemirror";

import "codemirror/src/codemirror.js";
import "codemirror/src/modes";

import "codemirror/mode/javascript/javascript";

import "codemirror/addon/edit/closebrackets";
import "codemirror/addon/edit/closetag";
import "codemirror/addon/edit/continuelist";
import "codemirror/addon/edit/matchbrackets";
import "codemirror/addon/edit/matchtags";
import "codemirror/addon/edit/trailingspace";

import "codemirror/addon/fold/brace-fold";
import "codemirror/addon/fold/comment-fold";
import "codemirror/addon/fold/foldcode";
import "codemirror/addon/fold/foldgutter";
import "codemirror/addon/fold/indent-fold";
import "codemirror/addon/fold/markdown-fold";
import "codemirror/addon/fold/xml-fold";
import "codemirror/addon/fold/foldgutter.css";

// Dark Mode
import "codemirror/theme/darcula.css";

window.CodeMirror = CodeMirror;
