<?php


use App\Http\Controllers\Admin\{AuthController, DashboardController, ServiceController, EnquiryController, TempImageController, AstrologerController};
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BusinesController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\FeedbacksController;
use App\Http\Controllers\Frontend\BlogsController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\EventsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FeedbackController;
use App\Http\Controllers\Frontend\ServicesController;
use App\Http\Controllers\Frontend\PaypalController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactformController;
use Illuminate\Support\Facades\Route;

// use App\Models\Admin;
// use App\Http\Controllers\CustomController;



// use App\Models\UsersRole;
use App\Models\User;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
// */

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');

Route::get('service', [ServicesController::class, 'index'])->name('serviceview');
Route::get('service/detail/{id}', [ServicesController::class, 'detail'])->name('servicedetail');

// Route::get('/event', function () {
//     return view('Frontend.event');
// });
Route::get('/event', [EventsController::class, 'index'])->name('Front.event');
Route::get('/event-detail/{name}', [EventsController::class, 'detail']);

Route::get('/testimonial', function () {
    return view('Frontend.testimonial');
});

Route::get('/book', function () {
    return view('Frontend.booking');
});
Route::post('/bookstore', function () {
    return view('Frontend.booking');
});
// Faq route here
Route::get('/faq', [FaqController::class, 'index'])->name('Front.faq');
Route::post('/faq', [FaqController::class, 'store'])->name('Front.faqStore');


Route::get('/event', [EventsController::class, 'index'])->name('Front.event');
// front blogs route
Route::get('/blogs', [BlogsController::class, 'index'])->name('Front.blogs');
Route::get('/blog-detail/{id}', [BlogsController::class, 'blogdetail']);



Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');


Route::get('/user-appointment', [AppointmentsController::class, 'index'])->name('appointments');
Route::post('/user-reserves', [AppointmentsController::class, 'reservesAppointment'])->name('reserves');

// Payment
Route::prefix('pay-with-Payumoney')->name('pay-with-Payumoney')->group(function () {
    Route::get('/pay', [PaymentController::class, 'index'])->name('.view');
    Route::post('/success', 'PaymentController@success')->name('.success');
    Route::get('/error', 'PaymentController@error')->name('.error');
});


// Payment route
Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');



Route::get('/contact', [ContactformController::class, 'index'])->name('Frontend.contact');
Route::post('/contact', [ContactformController::class, 'store'])->name('Frontend.contactpost');



Route::get('/login', [UserController::class, 'index'])->name('Frontend.login');
Route::post('/login', [UserController::class, 'loginUser'])->name('Frontend.loginpost');
Route::get('/register', [UserController::class, 'register'])->name('Frontend.register');
Route::post('/register', [UserController::class, 'saveUser'])->name('Frontend.registerpost');
Route::get('/forget', [UserController::class, 'forget'])->name('Frontend.forget');
Route::post('/forget', [UserController::class, 'forgetPassword'])->name('Frontend.forgetpost');
Route::get('/reset', [UserController::class, 'reset'])->name('Frontend.reset');
Route::get('/reset/{email}/{token}', [UserController::class, 'reset'])->name('reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('Frontend.resetpost');


Route::group(['middleware' => ['LoginCheck']], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('Frontend.Profile.profile');
    Route::post('/profile-image', [UserController::class, 'profileImageUpdate'])->name('Frontend.Profile.profile.image');
    Route::post('/profile-update', [UserController::class, 'profileUpdate'])->name('Frontend.Profile.profile.update');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

// Sub admin Dashboard
Route::group(['prefix' => 'sub/admin', 'namespace' => 'Subadmin'], function () {
    Route::get('login', [AuthController::class, 'subgetLogin'])->name('Admins.SubAdmin.login');
    Route::post('login', [AuthController::class, 'subpostLogin'])->name('subpostlogin');

    Route::group(['middleware' => 'subadmin.auth'], function () {
        Route::get('subdashboard', [DashboardController::class, 'subdashboard'])->name('subdashboard');
    });
});



// Super Admin dashboard
Route::group(['prefix' => 'super/admin', 'namespace' => 'Admin'], function () {
    Route::get('login', [AuthController::class, 'getLogin'])->name('Admins.SuperAdmin.login');
    Route::post('login', [AuthController::class, 'postLogin'])->name('postlogin');


    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        // User Super Admin Panel route
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::post('/users', [DashboardController::class, 'saveUser'])->name('userAddPost');
        Route::get('user-view/{id}', [DashboardController::class, 'showUser'])->name('showUsers');
        Route::get('edituser/{id}', [DashboardController::class, 'editUser'])->name('editUser');
        Route::post('userdelete/{id}', [DashboardController::class, 'delUser'])->name('delUser');
        Route::post('userUpadte/{id}', [DashboardController::class, 'updateUser'])->name('updateUser');
        // Route::post('/userStatus/{id}', [DashboardController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/users-changeStatus/{id}', [DashboardController::class, 'changeStatus'])->name('changeStatus');

        // Profile Route here

        Route::get('/profile', [ProfileController::class, 'index'])->name('Admin.profile');
        Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('Admin.profileupdate');

        // Banner start here
        Route::get('/banner', [BannerController::class, 'index'])->name('banner');
        Route::post('banner', [BannerController::class, 'store'])->name('banner.store');
        Route::get('banner/edit/{id}', [BannerController::class, 'editBanner'])->name('editBanner');
        Route::post('banner/update/{id}', [BannerController::class, 'update'])->name('updateBanner');
        Route::post('banner/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');


        // Service Super Admin Panel route
        Route::get('/services/list', [ServiceController::class, 'index'])->name('serviceList');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('servicecreate');
        Route::post('/services/create', [ServiceController::class, 'storeService'])->name('servicestore');
        Route::get('/services/edit/{id}', [ServiceController::class, 'editService'])->name('editService');
        Route::post('/services/edit/{id}', [ServiceController::class, 'updateService'])->name('updateService');
        Route::post('servicesdelete/{id}', [ServiceController::class, 'delService'])->name('delService');
        Route::post('/temp/upload', [TempImageController::class, 'upload'])->name('tempUpload');

        //Super can create Our with admin panel Astrologer route
        Route::get('/astrologer', [AstrologerController::class, 'index'])->name('astrologer');
        Route::get('/astrologer/create', [AstrologerController::class, 'create'])->name('astrologerCreate');
        Route::post('/astrologer/store', [AstrologerController::class, 'store'])->name('astrologer.store');
        Route::get('/astrologer/edit/{id}', [AstrologerController::class, 'edit'])->name('astrologer.edit');
        Route::post('/astrologer/update/{id}', [AstrologerController::class, 'update'])->name('astrologer.update');
        Route::post('/astrologer/delete/{id}', [AstrologerController::class, 'destroy'])->name('astrologer.destroy');
        // Route::get('/update-status/{id}', 'AstrologerController@updateStatus')->name('update-status');

        Route::get('/feedback', [FeedbacksController::class, 'index'])->name('feedback');
        Route::get('/feedback/edit/{id}', [FeedbacksController::class, 'edit'])->name('feedback.edit');
        Route::post('/feedback/update/{id}', [FeedbacksController::class, 'update'])->name('feedback.update');
        Route::post('/feedback/delete/{id}', [FeedbacksController::class, 'destroy'])->name('delfeeds');
        // web.php or routes file

        // BusinessHours Route here
        Route::get('/slot-shedule', [BusinesController::class, 'index'])->name('businessHours');
        Route::post('/slot-shedule/update', [BusinesController::class, 'update'])->name('businessHoursupdate');

        // Appointment Route here
        Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment');
        Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
        // Blogs route here

        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs/create', [BlogController::class, 'storeblogs'])->name('blogsstore');
        Route::get('/blogs/edit/{id}', [BlogController::class, 'editblogs'])->name('editblogs');
        Route::post('/blogs/edit/{id}', [BlogController::class, 'updateblog'])->name('blogupdate');
        Route::post('blogs/delete/{id}', [BlogController::class, 'delblog'])->name('delblog');
        //EVents route here

        Route::get('/events', [EventController::class, 'index'])->name('events');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events/create', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/edit/{id}', [EventController::class, 'edit'])->name('events.edit');
        Route::post('/events/edit/{id}', [EventController::class, 'update'])->name('events.update');
        Route::post('/events/delete/{id}', [EventController::class, 'destroy'])->name('events.destroy');

        // Faq route here
        Route::get('/faq', [FaqsController::class, 'index'])->name('faq');
        Route::get('/faq/edit/{id}', [FaqsController::class, 'edit'])->name('faq.edit');
        Route::post('/faq/update/{id}', [FaqsController::class, 'update'])->name('faq.update');
        Route::post('/faq/delete/{id}', [FaqsController::class, 'destroy'])->name('faq.destroy');

        // Enquiry Route here
        Route::get('/enquiry', [EnquiryController::class, 'index'])->name('enquiry');

        Route::get('/logout', [AuthController::class, 'logout'])->name('logouts');
    });
});
