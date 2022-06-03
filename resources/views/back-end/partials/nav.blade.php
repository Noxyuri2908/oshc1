<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            @include('back-end.partials.nav-header')
            <li class="landing_link">
                <a target="_blank" href="{{route('crm.dashboard')}}"><i class="fa fa-cubes"></i> <span class="nav-label">CRM OSHC</span></a>
            </li>
            <li class={{$flag == "post" ||  $flag == "category" ||  $flag == "tags" ||  $flag == "comment" || $flag == "media" || $flag == "album" ? "active" : ""}}>
                <a href="#"><i class="fa fa-file-text-o"></i> <span class="nav-label">NEWS / MEDIA / SEO</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "post"  ? "active" : ""}}><a href="{{route('post.index')}}">Posts</a></li>
                    <li class={{$flag == "comment"  ? "active" : ""}}><a href="{{route('comment.index')}}">Comments</a></li>
                    <li class={{$flag == "category"  ? "active" : ""}}><a href="{{route('category.index')}}">Categories</a></li>
                    <li class={{$flag == "tags"  ? "active" : ""}}><a href="{{route('tag.index')}}">Tags</a></li>
                    <hr/>
                    <li class={{$flag == "album"  ? "active" : ""}}><a href="{{route('album.index')}}">Album</a></li>
                    <li class={{$flag == "media"  ? "active" : ""}}><a href="{{route('media.index')}}">Media</a></li>
                    <hr/>
                    <li class={{$flag == "seo"  ? "active" : ""}}><a href="{{route('seo.index')}}">SEO</a></li>
                </ul>
            </li>
            <li class={{$flag == "conf" ||$flag == "service" ||  $flag == "doc" ||  $flag == "price" ||  $flag == "benefit" || $flag == "cat-benefit"
                    ? "active" : ""}}>
                <a href="#"><i class="fa fa-twitter"></i> <span class="nav-label">SERVICES</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "service"  ? "active" : ""}}><a href="{{route('service.index')}}">Services</a></li>
                    <li class={{$flag == "doc"  ? "active" : ""}}><a href="{{route('doc.index')}}">Documents</a></li>
                    <li class={{$flag == "price"  ? "active" : ""}}><a href="{{route('price.index')}}">Prices</a></li>
                    <li class={{$flag == "benefit"  ? "active" : ""}}><a href="{{route('benefit.index')}}">Benefits</a></li>
                    <li class={{$flag == "cat-benefit"  ? "active" : ""}}><a href="{{route('cat-benefit.index')}}">Type of benefit</a></li>
                    <li class={{$flag == "conf"  ? "active" : ""}}><a href="{{route('conf.index')}}">Content of benefit</a></li>
                </ul>
            </li>
            <li class={{$flag == "question" ||  $flag == "sub"
                    ? "active" : ""}}>
                <a href="#"><i class="fa fa-heart"></i> <span class="nav-label">FOLLOWERS</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "question"  ? "active" : ""}}><a href="{{route('question.index')}}">Asks</a></li>
                    <li class={{$flag == "sub"  ? "active" : ""}}><a href="{{route('sub.index')}}">Subcriber</a></li>
                </ul>
            </li>
            <li class={{$flag == "conf-mail" ||  $flag == "temp-mail" ? "active" : ""}}>
                <a href="{{route('conf-mail.index')}}"><i class="fa fa-paper-plane-o"></i> <span class="nav-label">MAIL</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "conf-mail"  ? "active" : ""}}><a href="{{route('conf-mail.index')}}">Content Mail</a></li>
                    <li class={{$flag == "temp-mail"  ? "active" : ""}}><a href="{{route('temp-mail.index')}}">Template Mail</a></li>
                </ul>
            </li>
            <li class={{$flag == "files" ||  $flag == "webinfo" ||  $flag == "section"
                    || $flag == "page"  || $flag == "banner" || $flag == "homepage" || $flag == "icon" || $flag == "content" || $flag == "menu" || $flag == "about"
                    ? "active" : ""}}>
                <a href="#"><i class="fa fa-wrench"></i> <span class="nav-label">SYSTEM</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "banner"  ? "active" : ""}}><a href="{{route('menu.index')}}">Menu Header</a></li>
                    <li class={{$flag == "banner"  ? "active" : ""}}><a href="{{route('banner.index')}}">Banner</a></li>
                    <li class={{$flag == "icon"  ? "active" : ""}}><a href="{{route('icon.index')}}">Icons</a></li>
                    <li class={{$flag == "page"  ? "active" : ""}}><a href="{{route('page.index')}}">Pages</a></li>
                    <li class={{$flag == "section"  ? "active" : ""}}><a href="{{route('section.index')}}">Sections</a></li>
                    <li class={{$flag == "content"  ? "active" : ""}}><a href="{{route('content.index')}}">Contents</a></li>
                    <li class={{$flag == "webinfo"  ? "active" : ""}}><a href="{{route('webinfo.index')}}">Web info</a></li>
                    <li class={{$flag == "files"  ? "active" : ""}}><a href="{{route('admin.files')}}">Source Files</a></li>
                    <li class={{$flag == "about"  ? "active" : ""}}><a href="{{route('admin.about-us')}}">About Us</a></li>
                    <li class={{$flag == "homepage"  ? "active" : ""}}><a href="{{route('admin.home-page')}}">Home page</a></li>

                </ul>
            </li>
            <li class={{$flag == "staff"  ? "active" : ""}}>
                <a href="{{route('staff.index')}}">
                    <i class="fa fa-users"></i>
                    <span class="nav-label">ADMIN</span>
                </a>
            </li>
            <li class={{$flag == "area" ||  $flag == "qa" ? "active" : ""}}>
                <a href="{{route('qa.index')}}"><i class="fa fa-info"></i> <span class="nav-label">Q&A</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class={{$flag == "area"  ? "active" : ""}}><a href="{{route('area.index')}}">Area</a></li>
                    <li class={{$flag == "qa"  ? "active" : ""}}><a href="{{route('qa.index')}}">Q&A</a></li>
                </ul>
            </li>
            <li class="landing_link">
                <a target="_blank" href="{{route('home')}}"><i class="fa fa-globe"></i> <span class="nav-label">OSHC GLOBAL</span></a>
            </li>
        </ul>
    </div>
</nav>
