---
marp:true
---

<style>
   {
      color:blue;
   }
   h1{
      text-align:center;
      background:tomato;
      color:white;
      padding-top:10px;
      padding-bottom:10px;
      border-radius:5px;
      margin-top:10px
   }
   </style>

# Create Method

```php

# Create Method in Laravel

public function index(){
   //some code
}

public function create(Request $request){

// return $request->all();

# Create Data
        $category = Category::create([
            'name' => $request->input('CategoryName'),
            'slug' => Str::slug($request->CategoryName),
            'type' => $request->type,
            'status' => $request->input('status')
            // 'image' => $request->image,
        ]);

        // Picture Upload With Data Insert

        if ($request->hasFile('FileUpload')) {
            $image = $request->file('FileUpload');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $url = $image->move('uploads/category/', $filename);
            $category->image = $url;
            $category->save();
        }
        else{

         $category = Category::create([
            'name' => $request->input('CategoryName'),
            'slug' => Str::slug($request->CategoryName),
            'type' => $request->type,
            'status' => $request->input('status')
        ]);

            // $category->save();
        }

        // $cat = Category::create($request->all());

        # Alternate Code

        $category = New Category(); // Object Create
        $category->name = $request->input('CategoryName');
        $category->slug = Str::slug($request->CategoryName);
        $category->type = $request->type;
        $category->status = $request->input('status');
        $category->save();


        return response()->json(['success' => true]);
        return response()->json(['success' => 'Category Create Successfully ... !!']);

        // return response($cat);

        return redirect()->route('category');

        $data = []; // array
        $data['name'] => $request->name;

        // return response()->json($data);

}

```
