<?php

// Admin Panel
Route::namespace('Admin')->prefix('admin')->middleware(['auth:web','admin','lastLogin'])->group(function () {
    Route::get('dashboard','AdminController@index')->name('adminDashboard');
    // Projects
    Route::resource('projects','ProjectController');
    Route::get('project/pending','ProjectController@pending')->name('projects.pending');
    Route::get('project/canceled','ProjectController@canceled')->name('projects.canceled');
    Route::get('project/closed','ProjectController@closed')->name('projects.closed');
    Route::patch('projects/active/{project}','ProjectController@confirm')->name('project.active');
    Route::patch('projects/deactivate/{project}','ProjectController@deactivate')->name('project.deactivate');
    Route::get('project/search','ProjectController@search')->name('projects.search');
    Route::post('project/search','ProjectController@searchPost')->name('projects.search.post');
    Route::delete('projects/offer/{offer}/delete','ProjectController@deleteOffer')->name('project.offer.delete');
    Route::patch('projects/offer/{offer}/assign','ProjectController@assign')->name('project.offer.assign');
    // Category
    Route::resource('categories','CategoryController');
    // Skills
    Route::resource('skills','SkillController');
    // Packages
    Route::resource('packages','PackageController');
    // Links
    Route::resource('links','LinkController');
    // Payment
    Route::get('payments','PaymentController@index')->name('payments.index');
    Route::get('payments/unsuccessful','PaymentController@unsuc')->name('payments.unsuc');
    Route::get('payments/successful','PaymentController@suc')->name('payments.suc');
    Route::get('payments/deposits','PaymentController@deposits')->name('payments.deposits');
    Route::get('payments/release','PaymentController@release')->name('payments.release');
    Route::get('withdraws','PaymentController@withdraws')->name('withdraws.index');
    Route::get('withdraws/pending','PaymentController@pending')->name('withdraws.pending');
    Route::get('withdraws/successful','PaymentController@successful')->name('withdraws.suc');
    Route::get('withdraws/canceled','PaymentController@canceled')->name('withdraws.canceled');
    Route::get('withdraws/{withdraw}','PaymentController@view')->name('withdraws.view');
    Route::patch('withdraws/{withdraw}','PaymentController@pay')->name('withdraws.pay');
    // Packages
    Route::resource('faqs','FaqController',['parameters' => [
        'faqs' => 'question'
    ]]);
    // Packages
    Route::resource('helps','HelpController',['parameters' => [
        'helps' => 'question'
    ]]);
    // Users
    Route::resource('users','UserController');
    Route::get('user/search','UserController@search')->name('users.search');
    Route::post('user/search','UserController@searchPost')->name('users.search.post');
    Route::patch('users/{user}/ban','UserController@ban')->name('users.ban');
    // Upload Files
    Route::group(['prefix'=>'uploadFile'],function (){
        // New Project
        Route::post('project','AdminController@projectUploadFile')->name('projectUploadFile');
    });
    // Site Settings
    Route::get('settings','SettingsController@index')->name('settings.index');
    Route::post('settings','SettingsController@update')->name('settings.update');
    // Site Settings
    Route::get('conversations','ConversationController@index')->name('conversation.index');
    Route::get('conversations/pending','ConversationController@pending')->name('conversation.pending');
    Route::get('conversations/rejected','ConversationController@rejected')->name('conversation.rejected');
    Route::patch('conversation/{conversation}/active','ConversationController@active')->name('conversation.active');
    Route::patch('conversation/{conversation}/reject','ConversationController@reject')->name('conversation.reject');
});

Route::namespace('User')->prefix('user')->middleware(['auth:web','lastLogin'])->group(function () {
    Route::get('dashboard','UserController@index')->name('userDashboard');
    // Project
    Route::get('project/new','ProjectController@index')->name('user.project.new');
    Route::post('project/new','ProjectController@store')->name('user.project.store');
    Route::get('project/{project}/edit','ProjectController@edit')->name('user.project.edit');
    Route::patch('project/{project}/update','ProjectController@update')->name('user.project.update');
    Route::post('project/new/categories','ProjectController@subcategory')->name('user.project.store.categories');
    Route::get('project/{project}','ProjectController@view')->name('user.project.view');
    // Deposit
    Route::get('project/{project}/deposits','ProjectController@deposit')->name('user.project.deposits');
    Route::patch('project/{project}/deposits','ProjectController@depositAction')->name('user.project.deposits.update');
    // Confirm
    Route::get('project/{project}/confirm','ProjectController@confirm')->name('project.confirm');
    // Release
    Route::get('project/{project}/release','ProjectController@release')->name('project.release');
    Route::patch('project/{project}/release','ProjectController@releaseAction')->name('project.release.update');
    // Make Vote
    Route::patch('project/{project}/vote','ProjectController@vote')->name('project.vote');
    // Project List
    Route::get('projects/all','ProjectController@all')->name('user.projects.all');
    Route::get('projects/urgent','ProjectController@urgent')->name('user.projects.urgent');
    Route::get('projects/special','ProjectController@special')->name('user.projects.special');
    Route::get('projects/related','ProjectController@related')->name('user.projects.related');
    Route::get('projects/hire','ProjectController@hire')->name('user.projects.hire');
    Route::get('projects/done','ProjectController@done')->name('user.projects.done');
    Route::post('projects/search','ProjectController@search')->name('user.projects.search');
    // Project Conversations Section
    Route::group(['prefix'=>'conversation'],function (){
        // Freelancer To Employer
        Route::get('/{project}','ProjectController@freelancerToEmployer')->name('conversations.fte');
        Route::post('/{project}','ProjectController@freelancerToEmployerStore')->name('conversations.fte.store');
        Route::get('/{project}/delete','ProjectController@freelancerToEmployerRemove')->name('conversations.fte.delete');
        // Employer To Freelancer
        Route::get('/{project}/{user}','ProjectController@employerToFreelancer')->name('conversations.etf');
        Route::post('/{project}/{user}','ProjectController@employerToFreelancerStore')->name('conversations.etf.store');
        // Accept Offer
        Route::patch('/{project}/{offer}/accept','ProjectController@acceptOffer')->name('project.accept.offer');
        // Pay Prepayment
        Route::get('/{project}/prepayment','ProjectController@employerPrepayment')->name('project.prepayment');
        // Pay Warranty
        Route::get('/{project}/warranty','ProjectController@freelancerWarranty')->name('project.warranty');
        // Convert To Hire
        Route::get('/{project}/make/hire','ProjectController@convertHire')->name('project.convert.hire');
        // Convert To Special
        Route::get('/{project}/make/special','ProjectController@convertSpecial')->name('project.convert.special');
        // Convert To Hidden
        Route::get('/{project}/make/hidden','ProjectController@convertHidden')->name('project.convert.hidden');
    });
    // Employer
    Route::get('employer/requests','EmployerController@index')->name('employer.requests');
    Route::post('employer/requests','EmployerController@filter')->name('employer.requests.filter');
    Route::get('employer/find','EmployerController@find')->name('employer.find');
    Route::post('employer/find','EmployerController@findFilter')->name('employer.find.filter');
    Route::get('employer/judgement','EmployerController@judge')->name('employer.judge');
    // Freelancer
    Route::get('freelancer/requests','FreelancerController@index')->name('freelancer.requests');
    Route::post('freelancer/requests','FreelancerController@filter')->name('freelancer.requests.filter');
    Route::get('freelancer/find','FreelancerController@find')->name('freelancer.find');
    Route::get('freelancer/judgement','FreelancerController@judge')->name('freelancer.judge');
    // Financial
    Route::group(['prefix'=>'financial'],function (){
        Route::get('/','FinancialController@index')->name('money.index');
        Route::get('/increase/credit','FinancialController@increase')->name('money.add');
        Route::get('/edit','FinancialController@edit')->name('money.edit');
        Route::post('/edit','FinancialController@store')->name('money.store');
        Route::get('/withdraw','FinancialController@withdraw')->name('money.withdraw');
        Route::post('/withdraw','FinancialController@withdrawStore')->name('money.withdraw.store');
        Route::get('/increase/credit/pay/{amount?}','FinancialController@pay')->name('money.pay');
        Route::post('/increase/credit/pay','FinancialController@payIt')->name('money.pay.online');
    });
    // Affiliate
    Route::group(['prefix'=>'affiliate'],function (){
        Route::get('/invite','AffliateController@index')->name('affiliate.invite');
        Route::get('/banner','AffliateController@banner')->name('affiliate.banner');
        Route::get('/report','AffliateController@report')->name('affiliate.report');
    });
    // Support
    Route::group(['prefix'=>'support'],function (){
        Route::get('/','SupportController@index')->name('support');
        Route::get('/contact','SupportController@contact')->name('support.contact');
    });
    // Rules
    Route::get('tos','UserController@rules')->name('rules');
    // Help
    Route::get('help','UserController@help')->name('help');
    Route::get('help/{id}','UserController@helpSingle')->name('help.single');
    // Faq
    Route::get('faq','UserController@faq')->name('faq');
    // About us
    Route::get('about','UserController@about')->name('about');
    // Profile
    Route::group(['prefix'=>'profile'],function (){
        Route::get('edit','UserController@profile')->name('profile');
        Route::patch('edit','UserController@profileUpdate')->name('profile.update');
        Route::get('avatar','UserController@avatar')->name('avatar');
        Route::post('avatar','UserController@avatarUpdate')->name('avatar.update');
        Route::get('password/change','UserController@password')->name('password.change');
        Route::patch('password/change','UserController@passwordUpdate')->name('password.change.update');
    });
    // Resume
    Route::group(['prefix'=>'resume'],function (){
        Route::get('/','UserController@resumeEdit')->name('resume.edit');
        Route::patch('/','UserController@resumeUpdate')->name('resume.update');
        Route::get('/me','UserController@resume')->name('resume.me');
        Route::get('/{user}','UserController@userResume')->name('resume.view');
    });
    Route::group(['prefix'=>'portfolios'],function (){
        Route::get('/','UserController@portfolio')->name('portfolio.index');
        Route::get('/show/{portfolio}','UserController@portfolioView')->name('portfolio.show');
        Route::get('/create','UserController@portfolioCreate')->name('portfolio.create');
        Route::get('/edit/{portfolio}','UserController@portfolioEdit')->name('portfolio.edit');
        Route::post('/create','UserController@portfolioStore')->name('portfolio.store');
        Route::post('/show/{portfolio}/like','UserController@portfolioLike')->name('portfolio.like');
        Route::post('/show/{portfolio}/remove','UserController@portfolioRemoveImage')->name('portfolio.remove');
        Route::patch('/{portfolio}/update','UserController@portfolioUpdate')->name('portfolio.update');
    });
    // VIP
    Route::get('premium','PremiumController@index')->name('premium');
    Route::get('premium/{package}','PremiumController@update')->name('premium.update');
    // Document Scan
    Route::get('document/upload','UserController@document')->name('document.upload');
    Route::post('document/upload','UserController@documentStore')->name('document.upload.store');
    // Notifications
    Route::get('notifications','UserController@notifications')->name('notifications');
    // Download File
    Route::get('/download/{id}','UserController@download')->name('download');
    // Notification View
    Route::get('notification/{notification}','UserController@viewNotification')->name('notification.view');
    // Invite
    Route::get('invite/{user}','UserController@invite')->name('invite.user');
    Route::get('invite/{user}/project/{project}','UserController@inviteIt')->name('invite.user.project');
    // Chat Application
    Route::get('api/users', 'UserController@chatFirst');
    Route::post('api/user/online', 'UserController@chatFourth');
    Route::get('api/user/read', 'UserController@chatFifth');
    Route::post('api/messages', 'UserController@chatSecond');
    Route::post('api/messages/send', 'UserController@chatThird');
    // Mobile Verification
    Route::post('api/phone', 'UserController@phoneVerify')->name('phone.verify');
    Route::post('api/phone/verify', 'UserController@phoneVerifyCode')->name('phone.verify.final');
    // Payment Verification
    Route::get('/api/payment/verification', 'FinancialController@verifyPayment')->name('payment.verify');
});


// Auth Routes
Auth::routes();
Route::group(['namespace'=>'Auth'],function (){
    // Auto login Routes
    Route::get('login/{driver}', 'LoginController@redirectToProvider')->name('autoLogin');
    Route::get('login/{driver}/callback', 'LoginController@handleProviderCallback')->name('autoLogin.callback');
});

Route::get('/home', function (){
    return redirect(route('userDashboard'));
})->name('home');

// Front
Route::group(['namespace'=>'Front'],function (){
    Route::get('/','HomeController@index')->name('index');
    Route::get('/clear',function (){
        \Illuminate\Support\Facades\Artisan::call('view:clear');
    });
});
