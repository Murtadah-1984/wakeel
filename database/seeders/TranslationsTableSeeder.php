<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\MenuItem;
use TCG\Voyager\Models\Page;
use TCG\Voyager\Models\Translation;

class TranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->dataTypesTranslations();
        $this->categoriesTranslations();
        $this->pagesTranslations();
        $this->menusTranslations();
    }

    private function categoriesTranslations()
    {
        $categories = Category::whereIn('slug', ['category-1', 'category-2'])->get();
        foreach ($categories as $cat) {
            $this->trans('pt', ['categories', 'slug', $cat->id], 'categoria-' . substr($cat->slug, -1));
            $this->trans('pt', ['categories', 'name', $cat->id], 'Categoria ' . substr($cat->slug, -1));
        }
    }

    private function dataTypesTranslations()
    {
        $fields = ['display_name_singular', 'display_name_plural'];
        $dataTypes = DataType::whereIn('display_name_singular', [
            'post', 'page', 'user', 'category', 'menu', 'role'
        ])->get();

        foreach ($dataTypes as $dataType) {
            foreach ($fields as $field) {
                $this->trans('pt', ['data_types', $field, $dataType->id], ucfirst($dataType->$field));
            }
        }
    }

    private function pagesTranslations()
    {
        $pages = Page::whereIn('slug', ['hello-world'])->get();
        foreach ($pages as $page) {
            $this->trans('pt', ['pages', 'title', $page->id], 'Olá Mundo');
            $this->trans('pt', ['pages', 'slug', $page->id], 'ola-mundo');
            $this->trans('pt', ['pages', 'body', $page->id], "Example content here");
        }
    }

    private function menusTranslations()
    {
        $menuItems = MenuItem::all();
        foreach ($menuItems as $item) {
            $this->trans('pt', ['menu_items', 'title', $item->id], $item->title . ' PT');
        }
    }

    private function trans($locale, $attributes, $value)
    {
        $translation = Translation::firstOrNew([
            'table_name'  => $attributes[0],
            'column_name' => $attributes[1],
            'foreign_key' => $attributes[2],
            'locale'      => $locale,
        ]);

        if (!$translation->exists || $translation->value !== $value) {
            $translation->value = $value;
            $translation->save();
        }
    }
}
