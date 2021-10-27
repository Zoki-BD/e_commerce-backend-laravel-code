<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   function addProduct(Request $request)
   {

      $product = new Product;

      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      $product->file_path = $request->file('file')->store('products');
      $product->save();

      return $product;
   }

   function productList()
   {

      $products = Product::all();


      // $products = Product::where('name', '=', 'nesto drugo')
      //          ->select(['id', 'name', 'price'])
      //          ->get();

      return $products;
   }

   //Ova id ke dojde od React delete kopceto, preku api fetch-ot od frontendot.
   function deleteProduct($id)
   {
      $result = Product::where('id', $id)->delete();

      if ($result) {
         return ["result" => "product has been deleted"];
      } else {
         return ['There is no such product in database'];
      }
   }

   function singleProduct($id)
   {
      $result = Product::find($id);
      return $result;
   }

   function editProduct($id, Request $request)
   {
      $product = Product::find($id);

      $product->name = $request->input('name');
      $product->price = $request->input('price');
      $product->description = $request->input('description');
      if ($request->file('file')) {
         $product->file_path = $request->file('file')->store('products');
      }
      $product->save();

      return $product;
   }

   //Za da imame search preku imeto na produktot
   function search($key)
   {
      //
      // $result = Product::where('name', $key)->get(); vaka samo celo ime koga ke go vneseme ke ni go dade produktot. A so toa dole i del od imeto ke prebaruva
      $result = Product::where('name', 'Like', "%$key%")->get();

      return $result;
   }
}
