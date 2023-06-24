<?php

use App\Http\Controllers\NewPostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use App\Models\Polypost;
use App\Models\Photo;
use App\Models\Tag;

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

/* normal routes function */

Route::get('/', function () {
    // return view('welcome');
    return "welcome to route";
});

Route::get('/myfirstroute', function () {
    return "this is my first route";
});

Route::get('thisismypost/{pstno}', function ($pst) {
    return "this is my " . $pst . " number post";
});

Route::get('ohhyournameis/{name}/{sndname}', function ($name, $sndname) {
    return "full name is " . $name . " " . $sndname;
});

////////////////////////////////////////////////

/* naming routes */

Route::get('admin/example', array('as' => 'admin.home', function () {

    $url = route('admin.home');

    return "this is example buit showing home with url " . $url;
}));

////////////////////////////////////////////////


/* routes controller */

Route::get('/routecontroller', '\App\Http\Controllers\NewPostController@index');

Route::get('/routecontroller/{id}', '\App\Http\Controllers\NewPostController@show');

////////////////////////////////////////////////



/* new generation routes controller */

Route::get('/newroutecontroller', [NewPostController::class, 'index']);

Route::get('/newroutecontroller/{id}', [NewPostController::class, 'show']);

////////////////////////////////////////////////


/* routes resource controller */

// | GET|HEAD  | tes/keren              | keren.index   | App\Http\Controllers\TesController@index   | web          |
// | POST      | tes/keren              | keren.store   | App\Http\Controllers\TesController@store   | web          |
// | GET|HEAD  | tes/keren/create       | keren.create  | App\Http\Controllers\TesController@create  | web          |
// | GET|HEAD  | tes/keren/{keren}      | keren.show    | App\Http\Controllers\TesController@show    | web          |
// | PUT|PATCH | tes/keren/{keren}      | keren.update  | App\Http\Controllers\TesController@update  | web          |
// | DELETE    | tes/keren/{keren}      | keren.destroy | App\Http\Controllers\TesController@destroy | web          |
// | GET|HEAD  | tes/keren/{keren}/edit | keren.edit    | App\Http\Controllers\TesController@edit    | web          |

Route::resource('/resourcecontroller/methods', NewPostController::class);


////////////////////////////////////////////////


/* routes view load */

Route::get('contact', function () {

    $array_val = ['saikat', 'mudi', 'argha', 'banerjee'];

    return view('contactview', compact('array_val'));
});

Route::get('something', function () {
    return view('pages.something');
});

Route::get('/show/{id}', [NewPostController::class, 'show']);

Route::get('/edit/{id}/{name}/{sndname}', [NewPostController::class, 'edit']);


////////////////////////////////////////////////

/* routes direct view load */

Route::view('direct_view', 'pages.something');

////////////////////////////////////////////////


/* routes make view load */

//this process is deprecated //

// Route::get('makeview' , function(){
//    return View::make('makeview');
// });

////////////////////////////////////////////////

/* repository pattern */

Route::get('/repository', [CategoryController::class, 'index']);

////////////////////////////////////////////////

/* check bootstrap after installing */

Route::get('checkbootstrap', [CategoryController::class, 'bootscheck']);

////////////////////////////////////////////////

/* basic crud with db query*/

///////insert data///////

Route::get('insertbasic', function () {

    DB::insert('insert into posts(title,body) values(?,?)', ['php with laravel 1', 'details in laravel 2']);
});

///////select data///////

Route::get('readbasic', function () {
    $result = DB::select('select * from posts where id= ?', [1]);

    foreach ($result as $post) {
        return $post;
    }
});

///////update data///////

Route::get('updatebasic', function () {
    DB::update('update posts set title="updated title" where id=?', [1]);
});

///////delete data//////

Route::get('deletebasic', function () {
    DB::delete('delete from posts where id=?', [2]);
});


////////////////////////////////////////////////


/* basic crud with basic eloquent*/

///////////eloquent find all data//////////////

Route::get('/eloquentfindall', function () {
    $post = Post::all();

    foreach ($post as $p) {
        echo $p;
    }
});

///////////eloquent find single data//////////////

Route::get('/eloquentfind', function () {
    $post = Post::find(1);

    return $post;
});

///////////eloquent find data by order//////////////

Route::get('/orderby', function () {
    $posts = Post::orderBy('id', 'desc')->get();

    foreach ($posts as $post) {
        echo $post;
    }
});

///////////eloquent get only one value with where clause//////////////

Route::get('getonevalue', function () {
    $posts = Post::where('id', 1)->take(1)->get();

    foreach ($posts as $post) {
        echo $post;
    }
});

///////////eloquent find or fail//////////////

Route::get('findorfail', function () {
    $posts = Post::findOrFail(3);

    return $posts;
});

///////////eloquent where condition with > <//////////////

Route::get('wheregretless', function () {
    $posts = Post::where('id', '<', 2)->firstOrFail();

    return $posts;
});


//////eloquent insert data//////

Route::get('/basiceloquentinsert', function () {
    $post = new Post;

    $post->title = 'python learning';
    $post->body = 'python learning in details';

    $post->save();

    return $post;
});

Route::get('/basiceloquentcreate', function () {
    Post::create(['title' => 'lang learning', 'body' => 'lang learning in details']);
});

//////eloquent update data//////

Route::get('update1', function () {

    $post = Post::find(1);

    $post->title = 'updating 1 title';
    $post->body = 'updating 1 body';

    $post->save();
});


Route::get('update2', function () {

    Post::where('id', 1)->where('title', 'updating 1 title')->update(['title' => 'lang learning', 'body' => 'lang learning in details']);
});

//////eloquent delete data//////

Route::get('delete', function () {

    Post::findOrFail(6)->delete();
});

Route::get('delete2', function () {

    Post::where('title', 'lang learning')->delete();
});


Route::get('destroy', function () {

    Post::destroy(10);
});

Route::get('destroy2', function () {

    Post::destroy([3, 5]);
});


//////eloquent soft delete data//////


Route::get('/softdelete', function () {

    Post::findOrFail(7)->delete();       //first add '$table->softDeletes()' at migration and then use it in model and add 'deleted_at'
});

//////retrive trash data with all data//////

Route::get('/readsoftdelete', function () {

    $post = Post::withTrashed()->get();

    return $post;
});


//////retrive only trash data//////

Route::get('/readonlysoftdelete', function () {

    $post = Post::onlyTrashed()->get();

    return $post;
});

//////restore trash data//////

Route::get('/restoretrashdata', function () {

    $post = Post::onlyTrashed()->where('id', 7)->restore();

    return $post;
});

//////permanently delete data from trash//////

Route::get('deletedatafromtrash', function () {

    Post::onlyTrashed()->where('id', 7)->forceDelete();
});


//////permanently delete data//////

Route::get('permanentdeletedata', function () {

    Post::withTrashed()->forceDelete();
});

////////////////////////////////


/* basic eloquent relation*/

#***add 'user_id' column in 'posts' model

//////one to one direct relation////// #User to Post

Route::get('/user/{id}/post', function ($id) {

    //check 'post' function within 'User' model 

    return User::find($id)->post;
});

//////one to one inverse relation////// #Post to User

Route::get('/post/{id}/user', function ($id) {

    //check 'user' function within 'Post' model 

    return Post::find($id)->user;
});


//////one to many direct relation////// #User to Post

//check 'post_om' function within 'User' model 

Route::get('/posts/{id}', function ($id) {

    $posts = User::find($id)->post_om;

    foreach ($posts as $post) {
        echo $post;
    }
});

//////many to many direct relation//////

#need to create 'pivot table' for this relation

#finding 'role' of perticular 'user_id'

Route::get('role/{id}/user', function ($id) {

    //check 'roles' function within 'User' model 

    $roles = User::findorfail($id)->roles;

    foreach ($roles as $role) {
        echo $role;
    }

    // output : {"id":2,"name":"subscriber","created_at":null,"updated_at":null,"pivot":{"user_id":2,"role_id":2}}
});

#finding 'user' of perticular 'role_id'

Route::get('user/{id}/role', function ($id) {

    //check 'users' function within 'Role' model 

    $users = Role::find($id)->users;

    foreach ($users as $user) {
        echo $user;
    }

    // output : {"id":1,"name":"rftgft gtr","email":"gtrgtrgt@dref.gftgf","email_verified_at":null,"created_at":null,"updated_at":null,"pivot":{"role_id":1,"user_id":1,"created_at":"2022-09-08T14:39:19.000000Z"}}
});


//////has many through relation//////

#create country table,
#add 'country_id' to users

Route::get('/user/country/{id}', function ($id) {

    //check 'posts' function within 'Country' model 

    $country_posts = Country::find($id)->posts;

    foreach ($country_posts as $country_post) {

        echo $country_post;

        // output : {"id":1,"user_id":1,"title":"sk post","body":"sk_post_content","created_at":null,"updated_at":null,"deleted_at":null,"laravel_through_key":1}
    }

    #getting the 'post' of 'users' which 'country' belongs to '$id'

});


//////polymorphic relation//////

#create a table name 'photos' and make its 'model'
#create a table name 'polyposts' and make its 'model'

#***getting 'photo' from 'photos' table of perticular 'user_id'/'polypost_id' 

Route::get('/user/photos/{id}', function ($id) {

    //check 'photo' function within 'User' model 
    //check 'imageable' function within 'Photo' model 

    $user_photos = User::find($id)->photo;

    foreach ($user_photos as $photo) {
        echo $photo;

        // output : {"id":1,"path":"saikat.jpg","imageable_id":1,"imageable_type":"App\\Models\\User","created_at":null,"updated_at":null}
    }
});


Route::get('/polypost/photos/{id}', function ($id) {

    //check 'photo' function within 'Polypost' model 
    //check 'imageable' function within 'Photo' model 

    $polyposts_photos = Polypost::find($id)->photo;

    foreach ($polyposts_photos as $photo) {
        echo $photo;
    }
});


//////polymorphic inverse relation//////

#***getting details of 'others' from 'photos' table of perticular 'photo_id' 

Route::get('photo/{id}', function ($id) {

    //check 'imageable' function within 'Photo' model 

    $poly_result = Photo::findOrFail($id)->imageable;

    return $poly_result;

    // outout : {"id":2,"name":"argha","email":"argha@gmail.com","email_verified_at":null,"created_at":null,"updated_at":null,"country_id":1}
});


//////polymorphic many to many relation//////

#already exist 'Polypost' model
#create 'tag' model with 'migration'
#create 'taggable' 'migration'

#check all 3 migration files

Route::get('/polypost/{id}/tag', function ($id) {

    // check 'tags' functon within 'Polypost' model

    $taggable_tags = Polypost::find($id)->tags;

    foreach ($taggable_tags as $post) {
        echo $post;
    }

    // output : {"id":2,"name":"javascript","created_at":null,"updated_at":null,"pivot":{"taggable_id":1,"tag_id":2,"taggable_type":"App\\Models\\Polypost"}}
});



//////polymorphic many to many(getting the owner) relation//////

Route::get('/tag/{id}/polypost', function ($id) {

    $polypost_tags = Tag::find($id)->polyposts;

    foreach ($polypost_tags as $tag) {
        echo $tag;
    }

    // output : {"id":1,"title":"php title","body":"details in php\r\n","created_at":null,"updated_at":null,"pivot":{"tag_id":2,"taggable_id":1,"taggable_type":"App\\Models\\Polypost"}}
});
