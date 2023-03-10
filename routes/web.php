<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicationSupportController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\CategorySupportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreSupportController;
use App\Http\Controllers\UbigeoController;
use App\Http\Controllers\BookImageController;
use App\Http\Controllers\BookCommentController;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Index
Auth::routes();
Route::get('/', [IndexController::class, "index"])->name("index");
Route::get('publication', [IndexController::class, "getPublicationById"])->name("showPublication");
Route::get('book', [IndexController::class, "getBookById"])->name("showBook");
Route::get('libros/{libro}/comentarios', [IndexController::class, "bookComments"])->name("bookComments");
Route::post('libros/{libro}/comment', [IndexController::class, "bookComment"])->name("bookComment");

// Routes Ajax
Route::get('getProvincesByDepartament', [UbigeoController::class, "getProvincesByDepartament"])->name("getProvincesByDepartament");
Route::get('getDistrictsByProvince', [UbigeoController::class, "getDistrictsByProvince"])->name("getDistrictsByProvince");

// Routes for auth
Route::middleware(['auth'])->group(function () {

    //Route Profile User
    Route::get('perfil/{user}/edit', [ProfileController::class, "editProfile"])->name("editProfile");
    Route::put('perfil/{user}', [ProfileController::class, "updateProfile"])->name("updateProfile");
    Route::post('perfil/{user}', [ProfileController::class, "updateImageProfile"])->name("updateImageProfile");
    Route::delete('perfil/{user}', [ProfileController::class, "deleteImageProfile"])->name("deleteImageProfile");
    Route::get('perfil/{user}/cambiar-contraseña', [ProfileController::class, "editPassword"])->name("editPassword");
    Route::post('perfil/{user}/cambiar-contraseña', [ProfileController::class, "updatePassword"])->name("updatePassword");

    //Route Cart Products
    Route::get('carro-compras', [CartController::class, "index"])->name("cart");
    Route::post('cart/addProductToCart', [CartController::class, "addProductToCart"])->name("addProductToCart");
    Route::put('cart/updateProductToCart', [CartController::class, "updateProductToCart"])->name("updateProductToCart");
    Route::delete('cart/deleteProductToCart', [CartController::class, "deleteProductToCart"])->name("deleteProductToCart");
    Route::post('cart/process', [CartController::class, "processCart"])->name("processCart");
});

// Routes For Admin
Route::middleware(['auth', 'admin'])->group(function () {
    //Route private books
    Route::post('private/documents/books/{book}', function($book) {return Storage::download('private/documents/books/'.$book);})->name('downloadPdf');

    //Route Dashboard
    Route::get('admin/dashboard', [DashBoardController::class, "index"])->name("dashboard");

    //Route Support Books
    Route::resource('admin/mantenimiento-libros', BookController::class);
    Route::post('admin/mantenimiento-libros/{mantenimiento_libro}/changeState', [BookController::class, "changeStateBook"])->name("changeStateBook");

    //Route Support Book Images
    Route::get('admin/mantenimiento-libros/{mantenimiento_libro}/imagenes', [BookImageController::class, "getBookImagesByBook"])->name("getBookImagesById");
    Route::post('admin/mantenimiento-libros/{mantenimiento_libro}/imagenes', [BookImageController::class, "updateBookImages"])->name("updateBookImages");
    Route::delete('admin/mantenimiento-libros/{mantenimiento_libro}/imagenes/{imagen}', [BookImageController::class, "deleteBookImage"])->name("deleteBookImageById");
    Route::post('admin/changePositionBookImages', [BookImageController::class, "changePositionBookImages"])->name("changePositionBookImages");

    //Route Support Book Comments
    Route::get('admin/libros/comentarios', [BookCommentController::class, "getBookComments"])->name("getBookComments");
    Route::post('admin/changeStateBookComment', [BookCommentController::class, "changeStateBookComment"])->name("changeStateBookComment");

    //Route Support Categories
    Route::resource('admin/mantenimiento-categorias', CategorySupportController::class);
    Route::post('admin/mantenimiento-categorias/{mantenimiento_categoria}/changeState', [CategorySupportController::class, "changeStateCategory"])->name("changeStateCategory");

    //Route Support Publications
    Route::resource('admin/mantenimiento-publicaciones', PublicationSupportController::class);
    
    //Route Support Stores
    Route::resource('admin/mantenimiento-tiendas', StoreSupportController::class);

    //Route Ajax Charts
    Route::get('admin/getFiveBestBooks', [DashBoardController::class, "getFiveBestBooks"])->name("getFiveBestBooks");
    Route::get('admin/getSalesPerMonth', [DashBoardController::class, "getSalesPerMonth"])->name("getSalesPerMonth");
    Route::get('admin/getFiveBestCustomers', [DashBoardController::class, "getFiveBestCustomers"])->name("getFiveBestCustomers");

    //Route Report Books
    Route::get('admin/reporte/libros', [BookController::class, "bookReport"])->name("bookReport");
    Route::post('admin/reporte/libros', [BookController::class, "bookReport"])->name("bookReport");

    //Route Report Sales
    Route::get('admin/reporte/ventas', [SaleController::class, "saleReport"])->name("saleReport");
    Route::post('admin/reporte/ventas', [SaleController::class, "saleReport"])->name("saleReport");
    Route::get('admin/reporte/venta/{venta}/detalle', [SaleController::class, "saleDetailReport"])->name("saleDetailReport");
});
