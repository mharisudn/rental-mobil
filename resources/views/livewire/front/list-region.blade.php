<div class="col-span-2 grid grid-cols-2 gap-y-6 gap-x-4 lg:gap-x-[30px] relative">
        <!-- Province -->
        <div class="flex flex-col col-span-2 gap-3">
            <label for="" class="text-base font-semibold text-dark">
                Province
            </label>
            <select wire:model.live='province_id' name="province_code" id="province"
                    class="form-select text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                    required>
                <option value="">Pilih</option>
                @foreach ($province as $key => $item)
                    <option value="{{ $key }}" @selected($key == $province_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <!-- City -->
        <div class="flex flex-col col-span-2 gap-3">
            <label for="" class="text-base font-semibold text-dark">
                City
            </label>
            <select wire:model.live='city_id' name="city_code" id="city"
                    class="form-select text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                    required>
                <option value="">Pilih</option>
                @foreach ($city as $key => $item)
                    <option value="{{ $key }}" @selected($key==$city_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <!-- District -->
        <div class="flex flex-col col-span-2 gap-3">
            <label for="" class="text-base font-semibold text-dark">
                District
            </label>
            <select wire:model.live='district_id' name="district_code" id="district"
                    class="form-select text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                    required>
                <option value="">Pilih</option>
                @foreach ($district as $key => $item)
                    <option value="{{ $key }}" @selected($key==$district_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

        <!-- Village -->
        <div class="flex flex-col col-span-2 gap-3">
            <label for="" class="text-base font-semibold text-dark">
                Village
            </label>
            <select wire:model.live='village_id' name="village_code" id="village"
                    class="form-select text-base font-medium focus:border-primary focus:outline-none placeholder:text-secondary placeholder:font-normal px-[26px] py-4 border border-grey rounded-[50px] focus:before:appearance-none focus:before:!content-none"
                    required>
                <option value="">Pilih</option>
                @foreach ($village as $key => $item)
                    <option value="{{ $key }}" @selected($key==$village_id)>{{ $item }}</option>
                @endforeach
            </select>
        </div>

</div>
