<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div
        style="position: relative; border-radius: 0.375rem; overflow-x: scroll;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                const config = {
                    mode: {name: 'javascript', json: true},
                    readOnly: true,
                    lineNumbers: {{ json_encode($getHasLineNumbers()) }},
                    lineWrapping: {{ json_encode($getHasLineWrapping()) }},
                    autoCloseBrackets: {{ json_encode($getHasAutoCloseBrackets()) }},
                    viewportMargin: Infinity,
                    theme: '{{ $getHasDarkTheme() ? 'material' : 'default' }}',
                    foldGutter: {{ json_encode($getHasFoldingCode()) }},
                    @php
                        if($getHasFoldingCode()) {
                            echo "extraKeys: {'Ctrl-Q': function(cm) { cm.foldCode(cm.getCursor()); }},";
                        }
                    @endphp
                    gutters: {{ json_encode($getGutters()) }},
                    foldOptions: {
                        widget: (from, to) => {
                            var count = undefined;

                            // Get open / close token
                            var startToken = '{', endToken = '}';
                            var prevLine = {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.getLine(from.line);
                            if (prevLine.lastIndexOf('[') > prevLine.lastIndexOf('{')) {
                                startToken = '[', endToken = ']';
                            }

                            // Get json content
                            var internal = {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.getRange(from, to);
                            var toParse = startToken + internal + endToken;

                            // Get key count
                            try {
                                var parsed = JSON.parse(toParse);
                                count = Object.keys(parsed).length;
                            } catch(e) { }

                            return count ? `\u21A4${count}\u21A6` : '\u2194';
                        }
                    }
                };
                
                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }} = window.CodeMirror($refs.{{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}, config);

                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.setSize('100%', '100%');
                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                @php
                    if($getHasFoldedCode()) {
                        echo preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) . ".foldCode(window.CodeMirror.Pos(0, 0));";
                    }
                @endphp

                setTimeout(function() {
                        {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.refresh();
                }, 1);
            "
        >
            <div
                wire:ignore
                x-ref="{{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}"
            ></div>
        </div>
    </div>
</x-dynamic-component>
