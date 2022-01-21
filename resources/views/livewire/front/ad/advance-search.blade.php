<div class="accordion bg-transparent filter"
     id="accordionExample">
 <div class="accordion-item bg-transparent position-relative">
  <h2 class="accordion-header bg-transparent"
      id="headingOne">
   <button class="accordion-button bg-transparent right-apprance"
           type="button"
           data-bs-toggle="collapse"
           data-bs-target="#collapseTen"
           aria-expanded="true"
           aria-controls="collapseTen">
    جستجو پیشرفته
   </button>
  </h2>
  <select class="form-select absolot"
          wire:model="orderBy">
   <option value="">مرتب کردن براساس ارتباط</option>
   <option value="views-desc">مرتب کردن براساس بازدید(زیاد به کم)</option>
   <option value="views-asc">مرتب کردن براساس بازدید(کم به زیاد)</option>
   <option value="created_at-desc">مرتب کردن براساس تاریخ(جدید به قدیم)</option>
   <option value="created_at-asc">مرتب کردن براساس تاریخ(قدیم به جدید)</option>
  </select>
  <div id="collapseTen"
       class="accordion-collapse collapse bg-transparent"
       aria-labelledby="headingTen"
       data-bs-parent="#accordionExample">
   <div class="accordion-body">
    <div class="row g-2 align-items-center">
     <div class="col-md-3">
      <input type="checkbox"
             wire:model="specialAd"
             class="@error('specialAd') is-invalid  @enderror">
      <label for="">اگهی ویژه</label>
      @error('specialAd') <span class=" text-danger">{{ $message }}</span> @enderror
     </div>
     <form class="row g-3 col-md-9">
      {{-- <div class="col-md-4">
        <label class="form-label"
               for="specificSizeSelect">Preference</label>
        <select class="form-select"
                id="specificSizeSelect">
         <option selected>Choose...</option>
         <option value="1">One</option>
         <option value="2">Two</option>
         <option value="3">Three</option>
        </select>
       </div>--}}
      <div class="col-md-4">
       <label for="inputEmail4"
              class="form-label">کمترین قیمت</label>
       <input type="number"
              class="form-control @error('min') is-invalid  @enderror"
              wire:model="min"
              id="inputEmail4">
       @error('min') <span class=" text-danger">{{ $message }}</span> @enderror
      </div>
      <div class="col-md-4">
       <label for="inputPassword4"
              class="form-label">بیشترین قیمت</label>
       <input type="number"
              wire:model="max"
              class="form-control @error('max') is-invalid  @enderror"
              id="inputPassword4">
       @error('max') <span class=" text-danger">{{ $message }}</span> @enderror
      </div>
     </form>
    </div>
    <div>
     <button class="btn btn-primary mt-3 mt-md-0"
             wire:click="startSearch">جستجو
     </button>
    </div>
   </div>
  </div>
 </div>
</div>