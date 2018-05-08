<?php

namespace Pinfort\LaravelLangSelector\ViewComposers;

use Illuminate\View\View;
use Pinfort\LaravelLangSelector\Language;
use Config;

class UserLanguageComposer
{
    /**
     *
     * @var str
     */
    protected $user_current_language;

    /**
     *
     * @var list<str>
     */
    protected $site_available_languages;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        $lang = Language::get();
        if (is_null($lang)) {
            $lang = Config::get('app.locale');
        }
        $this->user_current_language = $lang;
        $language_name = Config::get('language.language_name');
        $languages = Config::get('language.available_languages');
        $lang_list = [];
        foreach ($languages as $value) {
            if (array_key_exists($value, $language_name)) {
                $lang_list[$value] = $language_name[$value];
            }
        }
        $this->site_available_languages = $lang_list;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user_current_language', $this->user_current_language);
        $view->with('site_available_languages', $this->site_available_languages);
    }
}
