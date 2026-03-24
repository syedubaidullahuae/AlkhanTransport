<div class="accordion" id="categoryAccordion">
   

    @foreach($categories as $key => $category)
        
        <div class="accordion-item mb-2">

            <!-- Header -->
            <h2 class="accordion-header" id="heading-{{ $category->id }}">
                <button class="accordion-button {{ $key != 0 ? 'collapsed' : '' }}" 
                        type="button" 
                        data-bs-toggle="collapse" 
                        data-bs-target="#collapse-{{ $category->id }}">
                    
                    {{ $category->name }}
                </button>
            </h2>

            <!-- Body -->
            <div id="collapse-{{ $category->id }}" 
                 class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}" 
                 data-bs-parent="#categoryAccordion">

                <div class="accordion-body">

                    <!-- Enable Checkbox -->
                    <div class="form-check mb-2">
                        <input type="checkbox"
                               class="form-check-input"
                               name="categories[]"
                               value="{{ $category->id }}"
                               {{ in_array($category->id, (array)$selected) ? 'checked' : '' }}>

                        <label class="form-check-label">
                            Enable this category
                        </label>
                    </div>

                    <!-- Slug Input -->
                    <div class="form-group mb-2">
                        <label><strong>Slug</strong></label>

                        <input type="text"
                               class="form-control"
                               name="slugs[{{ $category->id }}]"
                               value="{{ $category->slug }}"
                               placeholder="Enter slug (e.g. bus, van)">
                    </div>

                    <!-- Info -->
                    <small class="text-muted">
                        Default slug from DB. You can override it.
                    </small>

                </div>
            </div>

        </div>
    @endforeach

</div>