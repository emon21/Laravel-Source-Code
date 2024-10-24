/******************* Laravel Source Code  ************************* */


<?php


# ======================= Create Method in Laravel ====================== #

// return $request->all();

$cat = Category::create([
   'name' => $request->input('CategoryName'),
   'slug' => Str::slug($request->CategoryName),
   'type' => $request->type,
   'status' => $request->input('status')
   // 'image' => $request->image,
]);

// Picture Upload

if ($request->hasFile('FileUpload')) {
   $image = $request->file('FileUpload');
   $filename = time() . '.' . $image->getClientOriginalExtension();
   $url = $image->move('uploads/category/', $filename);
   $cat->image = $url;
   $cat->save();
} else {

   $cat->save();

}

// $cat = Category::create($request->all());

// ===================================== dsdgdgdfgh ===================== 


// $category = New Category();
// $category->name = $request->input('CategoryName');
// $category->slug = Str::slug($request->CategoryName);
// $category->type = $request->type;
// $category->status = $request->input('status');
// $category->save();


// return response()->json(['success' => true]);
// return response()->json(['success' => 'Category Create Successfully ... !!']);

// return response($cat);
return redirect()->route('category');

        // $data = [];

        // return response()->json($data);


# ======================= Edit Method in Laravel ====================== #

public function edit(string $id)
    {

        $category = Category::find($id);
        return view('backend.category.edit', compact('category'));
    }


# ======================= Update Method in Laravel ====================== #

public function update(Request $request, string $id)
    {

        // return $request->all();

        //update category

        // $cat = Category::findOrFail($id);
        // $cat = Category::find($id);
        // $cat = new Category();
      
        if ($request->hasFile('FileUpload')) {

            # old img delete
            $oldImg = Category::where('id',$id)->first();
            // return $oldImg;

            if (File::exists($oldImg->image)) {
                File::delete($oldImg->image);
            }
           
            # Image upload
            // $image = $request->file('FileUpload');
            // $file = $request->file('image');
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // $url = $file->move(public_path('uploads/car'), $filename);
            // $url = $file->move('uploads/category', $filename);
            // $url = $image->move('uploads/category/', $filename);

                // $file->move('uploads/car', $filename);
                // $url = uploadImage($request->file('image'), 'car');

            # Image upload
            $file = $request->file('FileUpload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // $url = $file->move(public_path('uploads/car'), $filename);

            $url = $file->move('uploads/category/',$filename);

            // $file->move('uploads/car', $filename);
            
            Category::where('id', $id)->update([
                'name' => $request->input('CategoryName'),
                'slug' => Str::slug($request->CategoryName),
                'type' => $request->type,
                'status' => $request->input('status'),
                'image' => $url
            ]);
           
        } else {


            Category::where('id', $id)->update([
                'name' => $request->input('CategoryName'),
                'slug' => Str::slug($request->CategoryName),
                'type' => $request->type,
                'status' => $request->input('status')
            ]);

         
            // $car->CarImage = 'uploads/default.jpg';
          
        }

        
        return redirect()->route('category');

        // $cat->update($request->all());
        // return response()->json(['success' => 'Category Update Successfully ... !!']);

        // $cat = Category::find($id);

        // $cat = Category::where('id', $id);
        // ->update($request->all());

        // return $cat;

        // $cat->update($request->all());
        return response()->json(['success' => 'Category Update Successfully ... !!']);
    }

# ======================= Show or View Method in Laravel ====================== #


# ======================= Delete Method in Laravel ====================== #


# ======================= Destroy Method in Laravel ====================== #

 public function destroy(string $id)
    {
        //
        $cat = Category::find($id); // find data from database

        // Delete Image with data

        if (File::exists($cat->image)) {
            File::delete($cat->image);
        }
        // return $cat;

        $cat->delete();  // delete data from database

        return redirect('category');

        // return response()->json(['success' => 'Category Delete Successfully ... !!']);
    }


    

# ======================= Status Change in Laravel ====================== #



# ======================= Select Option Change in Laravel ====================== #
/*

 <div class="form-group col-sm-2 ">
                                                <label for="status">Category:</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value=""> >> Chouse Status << </option>

                                                    <option value="publish"
                                                        {{ $category->status == 'publish' ? 'selected' : '' }}>
                                                        Publish</option>
                                                    <option value="draft"
                                                        {{ $category->status == 'draft' ? 'selected' : '' }}>
                                                        Draft</option>

                                                </select>
                                            </div>

*/


# ======================= Preview Image with Upload  in Laravel ====================== #


# ======================= Preview Image with Upload  in Laravel ====================== #

/*

<input type="file" class="form-control" name="FileUpload" onchange="previewImage(event);">

<img  @if ($category->image) src="{{ asset($category->image) }}" @else src="{{ asset('uploads/category/no-image.png') }}" @endif alt="" width="270px" height="250px" id="previewImg">

/*

# JS Code
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
*/

?>






