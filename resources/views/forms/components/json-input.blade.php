<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }} }"
        style="position: relative; border-radius: 0.375rem; overflow-x: scroll;"
        x-cloak
    >
        <div
            wire:ignore
            x-init="
                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }} = CodeMirror($refs.{{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}, {
                    mode: {name: 'javascript', json: true},
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
                    gutters: [
                        {{ json_encode($getHasLineNumbers()) }} ? 'CodeMirror-linenumbers' : '',
                        {{ json_encode($getHasFoldingCode()) }} ? 'CodeMirror-foldgutter' : '',
                    ],
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
                });

                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.setSize('100%', '100%');
                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.setValue({{ json_encode(json_encode($getState(), JSON_PRETTY_PRINT), JSON_UNESCAPED_SLASHES) }} ?? '{}');

                @php
                    if($getHasFoldedCode()) {
                        echo preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) . ".foldCode(CodeMirror.Pos(0, 0));";
                    }
                @endphp

                setTimeout(function() {
                        {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.refresh();
                }, 1);

                {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.on('change', function () {
                    try {
                        state = JSON.parse({{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.getValue())
                    } catch (e) {
                        state = {{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}.getValue();
                    }
                });
            "
        >
            <div
                wire:ignore
                x-ref="{{ preg_replace('/[^a-zA-Z0-9_]/', '_', $getId()) }}"
            ></div>
        </div>
    </div>
</x-dynamic-component>