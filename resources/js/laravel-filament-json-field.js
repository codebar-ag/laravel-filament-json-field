
import CodeMirror from "codemirror";

// Core CodeMirror
import "codemirror/lib/codemirror.css";

// Modes
import "codemirror/mode/javascript/javascript";

// Addons
import "codemirror/addon/edit/closebrackets";
import "codemirror/addon/edit/closetag";
import "codemirror/addon/edit/continuelist";
import "codemirror/addon/edit/matchbrackets";
import "codemirror/addon/edit/matchtags";
import "codemirror/addon/edit/trailingspace";

// Folding
import "codemirror/addon/fold/brace-fold";
import "codemirror/addon/fold/comment-fold";
import "codemirror/addon/fold/foldcode";
import "codemirror/addon/fold/foldgutter";
import "codemirror/addon/fold/indent-fold";
import "codemirror/addon/fold/markdown-fold";
import "codemirror/addon/fold/xml-fold";
import "codemirror/addon/fold/foldgutter.css";

// Themes
import "codemirror/theme/material.css";

// Make CodeMirror available globally
window.CodeMirror = CodeMirror;