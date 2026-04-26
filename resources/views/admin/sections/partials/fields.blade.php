<div class="row g-3">
    @foreach ($fields as $field)
        @php
            $fieldName = $field['name'];
            $columnClass = $field['column'] ?? 'col-12';
        @endphp

        @if (($field['type'] ?? 'text') === 'repeater')
            @php
                $rows = old("{$errorRoot}.{$fieldName}", $contentData[$fieldName] ?? ($field['example'] ?? []));
                $rows = is_array($rows) ? $rows : [];
                $rows = array_pad($rows, $field['rows'] ?? 1, []);
            @endphp

            <div class="col-12">
                <label class="form-label">{{ $field['label'] }}</label>
                <div class="vstack gap-3">
                    @foreach ($rows as $rowIndex => $rowData)
                        <div class="border rounded-3 p-3">
                            <div class="small fw-semibold text-secondary mb-3">
                                {{ $field['label'] }} {{ $rowIndex + 1 }}
                            </div>
                            @include('admin.sections.partials.fields', [
                                'fields' => $field['fields'] ?? [],
                                'contentData' => is_array($rowData) ? $rowData : [],
                                'inputRoot' => "{$inputRoot}[{$fieldName}][{$rowIndex}]",
                                'errorRoot' => "{$errorRoot}.{$fieldName}.{$rowIndex}",
                            ])
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            @php
                $errorKey = "{$errorRoot}.{$fieldName}";
                $inputName = "{$inputRoot}[{$fieldName}]";
                $value = old($errorKey, $contentData[$fieldName] ?? '');
            @endphp

            <div class="{{ $columnClass }}">
                <label class="form-label">{{ $field['label'] }}</label>

                @if (($field['type'] ?? 'text') === 'textarea')
                    <textarea name="{{ $inputName }}" rows="{{ $field['rows'] ?? 4 }}" class="form-control @error($errorKey) is-invalid @enderror">{{ $value }}</textarea>
                @else
                    <input type="{{ $field['type'] ?? 'text' }}" name="{{ $inputName }}" value="{{ $value }}" class="form-control @error($errorKey) is-invalid @enderror">
                @endif

                @error($errorKey)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        @endif
    @endforeach
</div>
