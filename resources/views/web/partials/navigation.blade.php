
<nav>
    <div class="container">
        <ul class="main-menu mob">
            <li><a href=""><label for="toggle">
                        <i class="fi fi-nav-icon"></i>
                    </label></a></li>
        </ul>
        <input type="checkbox" id="toggle">
        <ul id="menu" class="main-menu">
            <li><a href="/">Bosh sahifa</a></li>
            <li><a href="#">Boshqarma</a>
                <ul>
                    @foreach($g_pages->where('location', 'boshqarma') as $page)
                        <li><a href="#">{{ $page->title }}</a></li>
                        @if($loop->iteration == 2)
                            <li><a href="#">Rahbariyat</a></li>
                        @endif
                    @endforeach
                    <li><a href="">Ochiq ma’lumotlar</a></li>
                    <li><a href="">Bo’sh ish o’rinlari</a></li>
                </ul>
            </li>
            <li><a href="#">Hujjatlar</a>
                <ul>
                    <li><a href="">Buyruqlar</a></li>
                    <li><a href="">VSS buyruqlari</a></li>
                    <li><a href="">Boshqarma buyruqlari</a></li>
                    <li><a href="">Boshqa hujjatlar</a></li>
                </ul>
            </li>
            <li><a href="#">Muassasalar</a>
                <ul>
                    @foreach($g_pages->where('location', 'muassasalar') as $page)
                        <li><a href="#">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#">Attestatsiya</a></li>
            <li><a href="#">Loyihalar</a>
                <ul>
                    @foreach($g_pages->where('location', 'loyihalar') as $page)
                        <li><a href="#">{{ $page->title }}</a></li>
                    @endforeach
                    @foreach($g_categories->where('location', 'loyihalar') as $category)
                        <li><a href="#">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            @foreach($g_categories->where('location', 'yangiliklar') as $category)
            <li><a href="#">{{ $category->name }}</a></li>
            @endforeach
            <li><a href="">Aloqa</a></li>
        </ul>
    </div>
</nav>
