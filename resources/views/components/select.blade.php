<div>
    <label for="{{$id}}" class="block text-sm font-medium leading-6 text-gray900">{{$label}}</label>
    <div class="mt-2">
        <select
        id="{{ $id }}"
        name="{{ $name . ($multiple ? '[]':'') }}"
        @class([
            'block w-full rounded-md shadow-sm border-0 py-1.5 first-line:ring-1 ring-inset focus:ring-2 focus:ring-inset  sm:text-sm sm:max-w-xs sm:leading-6',
            'text-red-900 ring-red-300 focus:ring-red-500' => $errors->has($name),
            'text-gray-900 ring-gray-300 focus:ring-2 focus:ring-inset' => ! $errors->has($name),
            'form-select' => ! $multiple,
            'form-multiSelect' => $multiple,
        ])
        @if ($multiple) multiple @endif
        >
        @foreach ($list as $item)
            <option
                value="{{ $item->$optionsValues }}"
                @selected($valueIsCollection ? $value->contains($item->$optionsValues): $item->$optionsValues==$value)
            >
                {{ $item->$optionsTexts }}
            </option>
        @endforeach
    </select>

    </div>
    @error($name)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @if (!empty($help))
        <p class="mt-2 text-gray-500 text-bold">{{ $help }}</p>
    @endif
</div>
