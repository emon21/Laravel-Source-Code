---
---

# Image Upload && Preview Image

```html
# Step 1 => Input Tag

<div class="form-group col-sm-4">
  <label for="image">Image:</label>
  <input type="file" class="form-control" name="FileUpload" onchange="previewImage(event);"
  />
</div>

# Step 2 => Preview Div 

<div class="form-group col-sm-3 float-right">
  <label for="" class="col-sm-6 col-form-label pt-0">Preview Image</label>
  <div class="form-group">
    <img @if ($category- />image) src="{{ asset($category->image) }}" @else
    src="{{ asset('uploads/category/no-image.png') }}" @endif alt=""
    width="270px" height="250px" id="previewImg"> {{--
    <img
      src="https://cdn.vectorstock.com/i/500p/65/30/default-image-icon-missing-picture-page-vector-40546530.jpg"
      alt=""
    />
    --}}
  </div>
</div>
```

# Step 3 => JavaScript Code

```JavaScript

<script>
        // function previewImage(event) {

        function previewImage(event) {
            let input = event.target;
            let image = document.getElementById('previewImg');
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(data) {
                    image.src = data.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

```
