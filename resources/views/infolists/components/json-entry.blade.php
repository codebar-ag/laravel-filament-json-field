<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div
        x-data="{
            editor: null,
            init() {
                this.$nextTick(() => {
                    this.initializeEditor();
                });
            },
            initializeEditor() {
                if (typeof window.CodeMirror === 'undefined') {
                    setTimeout(() => this.initializeEditor(), 100);
                    return;
                }
                
                try {
                    this.editor = window.CodeMirror(this.$refs.cm, {
                        value: {{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}',
                        mode: 'application/json',
                        readOnly: true,
                        lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                        lineWrapping: {{ json_encode($getHasLineWrapping()) }},
                        autoCloseBrackets: {{ json_encode($getHasAutoCloseBrackets()) }},
                        viewportMargin: Infinity,
                        theme: '{{ $getHasDarkTheme() ? 'darcula' : 'default' }}',
                        foldGutter: {{ json_encode($getHasFoldingCode()) }},
                        @php
                            if($getHasFoldingCode()) {
                                echo "gutters: ['CodeMirror-linenumbers', 'CodeMirror-foldgutter'],";
                                echo "foldOptions: {";
                                echo "    widget: (from, to) => {";
                                echo "        let count;";
                                echo "        let startToken = '{', endToken = '}';";
                                echo "        let prevLine = this.editor.getLine(from.line);";
                                echo "        if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {";
                                echo "            startToken = '[', endToken = ']';";
                                echo "        }";
                                echo "        let internal = this.editor.getRange(from, to);";
                                echo "        let toParse = startToken + internal + endToken;";
                                echo "        try {";
                                echo "            let parsed = JSON.parse(toParse);";
                                echo "            count = Object.keys(parsed).length;";
                                echo "        } catch (e) {}";
                                echo "        return count ? `\\u21A4${count}\\u21A6` : '\\u2194';";
                                echo "    }";
                                echo "},";
                                echo "extraKeys: {";
                                echo "    'Ctrl-Q': function(cm) { cm.foldCode(cm.getCursor()); }";
                                echo "},";
                            }
                        @endphp
                    });
                    
                    this.editor.setSize('100%', '100%');
                    
                } catch (error) {
                    console.error('CodeMirror initialization failed:', error);
                }
            }
        }"
        wire:ignore
    >
        <div 
            x-ref="cm" 
            style="height: 200px; border: 1px solid #d1d5db; border-radius: 0.375rem;"
        ></div>
    </div>
</x-dynamic-component>
