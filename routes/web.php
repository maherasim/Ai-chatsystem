<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

 Route::get('deals-dashboard', [CustomAuthController::class, 'deals-dashboard']); 
//  Route::get('index', [CustomAuthController::class, 'index'])->name('index');
 Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
 Route::get('register', [CustomAuthController::class, 'register'])->name('register-user');
 Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
 Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
 Route::post('/logout', [CustomAuthController::class, 'signOut'])->name('logout');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/chat', function () {
    return view('index');
})->name('chat.index');

// Route::get('/chat', function () {
//     return view('index');
// })->name('chat');
Route::get('/Ai', function () {
    return view('Chats.Ai');
})->name('chat-ai');
Route::get('/tasks', function () {
    return view('Chats.task');
})->name('chat-task');
Route::get('/users', function () {
    return view('Chats.users');
})->name('chat-users');

Route::get('/groups', function () {
    return view('Chats.groups');
})->name('chat-groups');
Route::get('/project', function () {
    return view('Chats.project');
})->name('chat-project');

Route::get('/Apis', function () {
    return view('Chats.Api');
})->name('chat-api');
Route::get('/library', function () {
    return view('Chats.library');
})->name('chat-library');

Route::get('/settings', function () {
    return view('Chats.settings');
})->name('settings');
Route::get('/all-calls', function () {
    return view('all-calls');
})->name('all-calls');

Route::get('/group-chat', function () {
    return view('group-chat');
})->name('group-chat');

Route::get('/my-status', function () {
    return view('my-status');
})->name('my-status');
Route::get('/status', function () {
    return view('status');
})->name('status');
Route::get('/success', function () {
    return view('success');
})->name('success');
Route::get('/user-status', function () {
    return view('user-status');
})->name('user-status');
Route::get('/signin', function () {
    return view('signin');
})->name('signin');
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/reset-password', function () {
    return view('reset-password');
})->name('reset-password');
Route::get('/otp', function () {
    return view('otp');
})->name('otp');
Route::get('/forgot-password', function () {
    return view('forgot-password');
})->name('forgot-password');


Route::Group(['prefix' => 'admin'], function () { 

Route::get('/', function () {
return view('admin.index_admin');
})->name('index_admin');
Route::get('/index_admin', function () {
  return view('admin.index_admin');
 })->name('index_admin');
 Route::get('/abuse-message', function () {
 return view('admin.abuse-message');
})->name('abuse-message');
Route::get('/add-language', function () {
    return view('admin.add-language');
   })->name('add-language');
Route::get('/appearance-settings', function () {
    return view('admin.appearance-settings');
   })->name('appearance-settings');
Route::get('/app-settings', function () {
    return view('admin.app-settings');
   })->name('app-settings'); 
Route::get('/authentication-settings', function () {
    return view('admin.authentication-settings');
   })->name('authentication-settings');  
Route::get('/backup', function () {
    return view('admin.backup');
   })->name('backup');     
Route::get('/ban-address', function () {
    return view('admin.ban-address');
   })->name('ban-address'); 
   Route::get('/block-user', function () {
    return view('admin.block-user');
   })->name('block-user'); 
   Route::get('/call', function () {
    return view('admin.call');
   })->name('call'); 
   Route::get('/change-password', function () {
    return view('admin.change-password');
   })->name('change-password');  
   Route::get('/chat', function () {
    return view('admin.chat');
   })->name('chat'); 
   Route::get('/chat-settings', function () {
    return view('admin.chat-settings');
   })->name('chat-settings');   
   Route::get('/clear-cache', function () {
    return view('admin.clear-cache');
   })->name('clear-cache');
   Route::get('/custom-fields', function () {
    return view('admin.custom-fields');
   })->name('custom-fields'); 
   Route::get('/email-settings', function () {
    return view('admin.email-settings');
   })->name('email-settings');  
   Route::get('/forgot-password', function () {
    return view('admin.forgot-password');
   })->name('forgot-password');   
   Route::get('/gdpr', function () {
    return view('admin.gdpr');
   })->name('gdpr'); 
    Route::get('/group', function () {
    return view('admin.group');
   })->name('group'); 
   Route::get('/integrations', function () {
    return view('admin.integrations');
   })->name('integrations');  
   Route::get('/invite-user', function () {
    return view('admin.invite-user');
   })->name('invite-user');    
   Route::get('/language', function () {
    return view('admin.language');
   })->name('language');    
   Route::get('/language-web', function () {
    return view('admin.language-web');
   })->name('language-web');        
   Route::get('/localization-settings', function () {
    return view('admin.localization-settings');
   })->name('localization-settings');  
   Route::get('/login', function () {
    return view('admin.login');
   })->name('login');   
   Route::get('/notification-settings', function () {
    return view('admin.notification-settings');
   })->name('notification-settings');  
   Route::get('/otp', function () {
    return view('admin.otp');
   })->name('otp');   
   Route::get('/profile-settings', function () {
    return view('admin.profile-settings');
   })->name('profile-settings'); 
   Route::get('/report-user', function () {
    return view('admin.report-user');
   })->name('report-user');    
   Route::get('/reset-password-success', function () {
    return view('admin.reset-password-success');
   })->name('reset-password-success');  
   Route::get('/reset-password', function () {
    return view('admin.reset-password');
   })->name('reset-password');  
   Route::get('/sms-settings', function () {
    return view('admin.sms-settings');
   })->name('sms-settings');
   Route::get('/social-auth', function () {
    return view('admin.social-auth');
   })->name('social-auth');    
   Route::get('/storage', function () {
    return view('admin.storage');
   })->name('storage');
   Route::get('/stories', function () {
    return view('admin.stories');
   })->name('stories');
   Route::get('/video-audio-settings', function () {
    return view('admin.video-audio-settings');
   })->name('video-audio-settings');
   Route::get('/ui-alerts', function () {
    return view('admin.ui-alerts');
})->name('ui-alerts');

Route::get('/ui-accordion', function () {
    return view('admin.ui-accordion');
})->name('ui-accordion');

Route::get('/ui-avatar', function () {
    return view('admin.ui-avatar');
})->name('ui-avatar');

Route::get('/ui-badges', function () {
    return view('admin.ui-badges');
})->name('ui-badges');

Route::get('/ui-borders', function () {
    return view('admin.ui-borders');
})->name('ui-borders');

Route::get('/ui-buttons', function () {
    return view('admin.ui-buttons');
})->name('ui-buttons');

Route::get('/ui-buttons-group', function () {
    return view('admin.ui-buttons-group');
})->name('ui-buttons-group');

Route::get('/ui-breadcrumb', function () {
    return view('admin.ui-breadcrumb');
})->name('ui-breadcrumb');

Route::get('/ui-cards', function () {
    return view('admin.ui-cards');
})->name('ui-cards');

Route::get('/ui-carousel', function () {
    return view('admin.ui-carousel');
})->name('ui-carousel');

Route::get('/ui-colors', function () {
    return view('admin.ui-colors');
})->name('ui-colors');

Route::get('/ui-dropdowns', function () {
    return view('admin.ui-dropdowns');
})->name('ui-dropdowns');

Route::get('/ui-grid', function () {
    return view('admin.ui-grid');
})->name('ui-grid');

Route::get('/ui-images', function () {
    return view('admin.ui-images');
})->name('ui-images');

Route::get('/ui-lightbox', function () {
    return view('admin.ui-lightbox');
})->name('ui-lightbox');

Route::get('/ui-media', function () {
    return view('admin.ui-media');
})->name('ui-media');

Route::get('/ui-modals', function () {
    return view('admin.ui-modals');
})->name('ui-modals');

Route::get('/ui-offcanvas', function () {
    return view('admin.ui-offcanvas');
})->name('ui-offcanvas');

Route::get('/ui-pagination', function () {
    return view('admin.ui-pagination');
})->name('ui-pagination');

Route::get('/ui-popovers', function () {
    return view('admin.ui-popovers');
})->name('ui-popovers');

Route::get('/ui-progress', function () {
    return view('admin.ui-progress');
})->name('ui-progress');

Route::get('/ui-placeholders', function () {
    return view('admin.ui-placeholders');
})->name('ui-placeholders');

Route::get('/ui-rangeslider', function () {
    return view('admin.ui-rangeslider');
})->name('ui-rangeslider');

Route::get('/ui-spinner', function () {
    return view('admin.ui-spinner');
})->name('ui-spinner');

Route::get('/ui-sweetalerts', function () {
    return view('admin.ui-sweetalerts');
})->name('ui-sweetalerts');

Route::get('/ui-nav-tabs', function () {
    return view('admin.ui-nav-tabs');
})->name('ui-nav-tabs');

Route::get('/ui-toasts', function () {
    return view('admin.ui-toasts');
})->name('ui-toasts');

Route::get('/ui-tooltips', function () {
    return view('admin.ui-tooltips');
})->name('ui-tooltips');

Route::get('/ui-typography', function () {
    return view('admin.ui-typography');
})->name('ui-typography');

Route::get('/ui-video', function () {
    return view('admin.ui-video');
})->name('ui-video');

Route::get('/ui-ribbon', function () {
    return view('admin.ui-ribbon');
})->name('ui-ribbon');

Route::get('/ui-clipboard', function () {
    return view('admin.ui-clipboard');
})->name('ui-clipboard');

Route::get('/ui-drag-drop', function () {
    return view('admin.ui-drag-drop');
})->name('ui-drag-drop');

Route::get('/ui-rating', function () {
    return view('admin.ui-rating');
})->name('ui-rating');

Route::get('/ui-text-editor', function () {
    return view('admin.ui-text-editor');
})->name('ui-text-editor');

Route::get('/ui-counter', function () {
    return view('admin.ui-counter');
})->name('ui-counter');

Route::get('/ui-scrollbar', function () {
    return view('admin.ui-scrollbar');
})->name('ui-scrollbar');

Route::get('/ui-stickynote', function () {
    return view('admin.ui-stickynote');
})->name('ui-stickynote');

Route::get('/ui-timeline', function () {
    return view('admin.ui-timeline');
})->name('ui-timeline');

Route::get('/chart-apex', function () {
    return view('admin.chart-apex');
})->name('chart-apex');

Route::get('/chart-c3', function () {
    return view('admin.chart-c3');
})->name('chart-c3');  

Route::get('/chart-flot', function () {
    return view('admin.chart-flot');
})->name('chart-flot'); 

Route::get('/chart-js', function () {
    return view('admin.chart-js');
})->name('chart-js');    

Route::get('/chart-morris', function () {
    return view('admin.chart-morris');
})->name('chart-morris'); 

Route::get('/chart-peity', function () {
    return view('admin.chart-peity');
})->name('chart-peity');

Route::get('/icon-fontawesome', function () {
    return view('admin.icon-fontawesome');
})->name('icon-fontawesome');

Route::get('/icon-feather', function () {
    return view('admin.icon-feather');
})->name('icon-feather');

Route::get('/icon-ionic', function () {
    return view('admin.icon-ionic');
})->name('icon-ionic');

Route::get('/icon-material', function () {
    return view('admin.icon-material');
})->name('icon-material');

Route::get('/icon-pe7', function () {
    return view('admin.icon-pe7');
})->name('icon-pe7');

Route::get('/icon-simpleline', function () {
    return view('admin.icon-simpleline');
})->name('icon-simpleline');

Route::get('/icon-themify', function () {
    return view('admin.icon-themify');
})->name('icon-themify');

Route::get('/icon-weather', function () {
    return view('admin.icon-weather');
})->name('icon-weather');

Route::get('/icon-typicon', function () {
    return view('admin.icon-typicon');
})->name('icon-typicon');

Route::get('/icon-flag', function () {
    return view('admin.icon-flag');
})->name('icon-flag');

Route::get('/form-checkbox-radios', function () {
    return view('admin.form-checkbox-radios');
})->name('form-checkbox-radios');

Route::get('/form-floating-labels', function () {
    return view('admin.form-floating-labels');
})->name('form-floating-labels');

Route::get('/form-grid-gutters', function () {
    return view('admin.form-grid-gutters');
})->name('form-grid-gutters');

Route::get('/form-elements', function () {
    return view('admin.form-elements');
})->name('form-elements');

Route::get('/form-select', function () {
    return view('admin.form-select');
})->name('form-select');

Route::get('/form-select2', function () {
    return view('admin.form-select2');
})->name('form-select2');

Route::get('/form-fileupload', function () {
    return view('admin.form-fileupload');
})->name('form-fileupload');

Route::get('/form-wizard', function () {
    return view('admin.form-wizard');
})->name('form-wizard');

Route::get('/form-basic-inputs', function () {
    return view('admin.form-basic-inputs');
})->name('form-basic-inputs');

Route::get('/form-input-groups', function () {
    return view('admin.form-input-groups');
})->name('form-input-groups');

Route::get('/form-horizontal', function () {
    return view('admin.form-horizontal');
})->name('form-horizontal');

Route::get('/form-vertical', function () {
    return view('admin.form-vertical');
})->name('form-vertical');

Route::get('/form-mask', function () {
    return view('admin.form-mask');
})->name('form-mask');

Route::get('/form-validation', function () {
    return view('admin.form-validation');
})->name('form-validation');

Route::get('/tables-basic', function () {
    return view('admin.tables-basic');
})->name('tables-basic');

Route::get('/data-tables', function () {
    return view('admin.data-tables');
})->name('data-tables');

Route::get('/form-checkbox-radios', function () {
    return view('admin.form-checkbox-radios');
})->name('form-checkbox-radios');

Route::get('/form-floating-labels', function () {
    return view('admin.form-floating-labels');
})->name('form-floating-labels');

Route::get('/form-grid-gutters', function () {
    return view('admin.form-grid-gutters');
})->name('form-grid-gutters');

Route::get('/form-elements', function () {
    return view('admin.form-elements');
})->name('form-elements');

Route::get('/form-select', function () {
    return view('admin.form-select');
})->name('form-select');

Route::get('/form-select2', function () {
    return view('admin.form-select2');
})->name('form-select2');

Route::get('/form-fileupload', function () {
    return view('admin.form-fileupload');
})->name('form-fileupload');

Route::get('/form-wizard', function () {
    return view('admin.form-wizard');
})->name('form-wizard');

Route::get('/form-basic-inputs', function () {
    return view('admin.form-basic-inputs');
})->name('form-basic-inputs');

Route::get('/form-input-groups', function () {
    return view('admin.form-input-groups');
})->name('form-input-groups');

Route::get('/form-horizontal', function () {
    return view('admin.form-horizontal');
})->name('form-horizontal');

Route::get('/form-vertical', function () {
    return view('admin.form-vertical');
})->name('form-vertical');

Route::get('/form-mask', function () {
    return view('admin.form-mask');
})->name('form-mask');

Route::get('/form-validation', function () {
    return view('admin.form-validation');
})->name('form-validation');

Route::get('/users', function () {
    return view('admin.users');
})->name('users');


});



