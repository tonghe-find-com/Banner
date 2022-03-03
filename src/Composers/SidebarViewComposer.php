<?php

namespace Tonghe\Modules\Banners\Composers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;

class SidebarViewComposer
{
    public function compose(View $view)
    {
        if (Gate::denies('read banners')) {
            return;
        }
        $view->sidebar->group(__('Homepage'), function (SidebarGroup $group) {
            $group->id = 'Homepage';
            $group->weight = 22;
            $group->addItem(__('Banners'), function (SidebarItem $item) {
                $item->id = 'banners';
                $item->icon = config('typicms.banners.sidebar.icon');
                $item->weight = 1;
                $item->route('admin::index-banners');
                $item->append('admin::create-banner');
            });
        });
    }
}
