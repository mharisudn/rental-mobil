<div>
    <!-- Grid Brand and Type -->
    <div class="grid grid-cols md:grid-cols-2 md:gap-4">
        <div class="mb-5 md:mb-0 w-full">
            <label for="province" class="block text-sm font-medium text-slate-600 mb-2 ">
                Province
                <span class="text-rose-500">*</span>
            </label>
            <select wire:model.live='province_id' name="province_code" id="province"
                    class="form-select w-full focus:border-blue-500" required>
                <option value="">Pilih</option>
                @foreach ($province as $key => $item)
                    <option value="{{ $key }}" @selected($key == $province_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5 md:mb-0 w-full">
            <label for="city" class="block text-sm font-medium text-slate-600 mb-2 ">
                City
                <span class="text-rose-500">*</span>
            </label>
            <select wire:model.live='city_id' name="city_code" id="city"
                    class="form-select w-full focus:border-blue-500" required>
                <option value="">Pilih</option>
                @foreach ($city as $key => $item)
                    <option value="{{ $key }}" @selected($key==$city_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5 w-full">
            <label for="district" class="block text-sm font-medium text-slate-600 mb-2 ">
                District
                <span class="text-rose-500">*</span>
            </label>
            <select wire:model.live='district_id' name="district_code" id="district"
                    class="form-select w-full focus:border-blue-500" required>
                <option value="">Pilih</option>
                @foreach ($district as $key => $item)
                    <option value="{{ $key }}" @selected($key==$district_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5 w-full">
            <label for="village" class="block text-sm font-medium text-slate-600 mb-2 ">
                Village
                <span class="text-rose-500">*</span>
            </label>
            <select wire:model.live='village_id' name="village_code" id="village"
                    class="form-select w-full focus:border-blue-500" required>
                <option value="">Pilih</option>
                @foreach ($village as $key => $item)
                    <option value="{{ $key }}" @selected($key==$village_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

    </div>
</div>
