<div id="subnav" class="subnav">
    <notempty name="_extra_menu">
        {// 动态扩展菜单 //}
        {:extra_menu($_extra_menu,$__MENU__)}
    </notempty>
    <volist name="__MENU__.child" id="sub_menu">
        <!-- 子导航 -->
        <notempty name="sub_menu">
            <notempty name="key"><h3><i class="icon icon-unfold"></i>{$key}</h3></notempty>
            <ul class="side-sub-menu">
                <volist name="sub_menu" id="menu">
                    <li>
                        <a class="item" href="{$menu.url|U}">{$menu.title}</a>
                    </li>
                </volist>
            </ul>
        </notempty>
        <!-- /子导航 -->
    </volist>
 <h3>
 	<i class="icon <notin name="Think.ACTION_NAME"  value="mydocument,draftbox,examine">icon-fold</notin>"></i>
 	个人中心
 </h3>
 	<ul class="side-sub-menu <notin name="Think.ACTION_NAME"  value="mydocument,draftbox,examine">subnav-off</notin>">
 		<li <eq name="Think.ACTION_NAME" value="mydocument">class="current"</eq>><a class="item" href="{:U('article/mydocument')}">我的文档</a></li>
 		<eq name="show_draftbox" value="1">
 		<li <eq name="Think.ACTION_NAME" value="draftbox">class="current"</eq>><a class="item" href="{:U('article/draftbox')}">草稿箱</a></li>
 		</eq>
		<li <eq name="Think.ACTION_NAME" value="draftbox">class="examine"</eq>><a class="item" href="{:U('article/examine')}">待审核</a></li>
 	</ul>

    <volist name="nodes" id="sub_menu">
        <!-- 子导航 -->
        <notempty name="sub_menu">
            <h3>
            	<i class="icon <neq name="sub_menu['current']" value="1">icon-fold</neq>"></i>
            	<gt name="sub_menu['allow_publish']" value="0"><a class="item" href="{$sub_menu.url|U}">{$sub_menu.title}</a><else/>{$sub_menu.title}</gt>
            </h3>
            <ul class="side-sub-menu <neq name='sub_menu["current"]' value="1">subnav-off</neq>">
                <volist name="sub_menu['_child']" id="menu">
                    <li <if condition="$menu['id'] eq $cate_id or $menu['current'] eq 1">class="current"</if>>
                        <gt name="menu['allow_publish']" value="0"><a class="item" href="{$menu.url|U}">{$menu.title}</a><else/><a class="item" href="javascript:void(0);">{$menu.title}</a></gt>

                        <!-- 一级子菜单 -->
                        <present name="menu['_child']">
                        <ul class="subitem">
                        	<foreach name="menu['_child']" item="three_menu">
                            <li>
                                <gt name="three_menu['allow_publish']" value="0"><a class="item" href="{$three_menu.url|U}">{$three_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$three_menu.title}</a></gt>
                                <!-- 二级子菜单 -->
                                <present name="three_menu['_child']">
                                <ul class="subitem">
                                	<foreach name="three_menu['_child']" item="four_menu">
                                    <li>
                                        <gt name="four_menu['allow_publish']" value="0"><a class="item" href="{:U('index','cate_id='.$four_menu['id'])}">{$four_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$four_menu.title}</a></gt>
                                        <!-- 三级子菜单 -->
                                        <present name="four_menu['_child']">
                                        <ul class="subitem">
                                        	<volist name="four_menu['_child']" id="five_menu">
                                            <li>
                                            	<gt name="five_menu['allow_publish']" value="0"><a class="item" href="{:U('index','cate_id='.$five_menu['id'])}">{$five_menu.title}</a><else/><a class="item" href="javascript:void(0);">{$five_menu.title}</a></gt>
                                            </li>
                                            </volist>
                                        </ul>
                                        </present>
                                        <!-- end 三级子菜单 -->
                                    </li>
                                     </foreach>
                                </ul>
                                </present>
                                <!-- end 二级子菜单 -->
                            </li>
                            </foreach>
                        </ul>
                        </present>
                        <!-- end 一级子菜单 -->
                    </li>
                </volist>
            </ul>
        </notempty>
        <!-- /子导航 -->
    </volist>
    <!-- 回收站 -->
	<eq name="show_recycle" value="1">
    <h3>
        <em class="recycle"></em>
        <a href="{:U('article/recycle')}">回收站</a>
    </h3>
    </eq>
</div>
<script>
    $(function(){
        $(".side-sub-menu li").hover(function(){
            $(this).addClass("hover");
        },function(){
            $(this).removeClass("hover");
        });
    })
</script>
