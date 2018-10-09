<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:74:"D:\item\www.shop.com\public/../application/admin\view\attribute\index.html";i:1535879424;s:61:"D:\item\www.shop.com\application\admin\view\public\place.html";i:1535884627;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="<?php echo config('static_admin'); ?>/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo config('static_admin'); ?>/css/page.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo config('static_admin'); ?>/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".click").click(function() {
            $(".tip").fadeIn(200);
        });

        $(".tiptop a").click(function() {
            $(".tip").fadeOut(200);
        });

        $(".sure").click(function() {
            $(".tip").fadeOut(100);
        });

        $(".cancel").click(function() {
            $(".tip").fadeOut(100);
        });

    });
    </script>
</head>

<body>
    <!--<div class="place">-->
        <!--<span>位置：</span>-->
        <!--<ul class="placeul">-->
            <!--<li><a href="#">首页</a></li>-->
            <!--<li><a href="#">数据表</a></li>-->
            <!--<li><a href="#">基本内容</a></li>-->
        <!--</ul>-->
    <!--</div>-->
    <div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="javascript:void(0);">首页</a></li>
        <?php $break = session('break');foreach($break as $v):if($v['pid'] == 0):?>
        <li><a href="javascript:void(0);"><?php echo $v['auth_name'];?></a></li>
        <?php else:?>
        <li><a href="<?php echo url('/admin/' . $v['auth_c'] . '/' . $v['auth_a'],['auth_id'=>$v['auth_id']]); ?>"><?php echo $v['auth_name'];?></a></li>
        <?php endif;endforeach;?>
    </ul>
</div>

    <div class="rightinfo">
        <div class="tools">
            <ul class="toolbar">
                <li><span><img src="<?php echo config('static_admin'); ?>/images/t01.png" /></span>添加</li>
                <li><span><img src="<?php echo config('static_admin'); ?>/images/t02.png" /></span>修改</li>
                <li><span><img src="<?php echo config('static_admin'); ?>/images/t03.png" /></span>删除</li>
                <li><span><img src="<?php echo config('static_admin'); ?>/images/t04.png" /></span>统计</li>
            </ul>
        </div>
        <table class="tablelist">
            <thead>
                <tr>
                    <th>
                        <input name="" type="checkbox" value="" id="checkAll" />
                    </th>
                    <th>序号</th>
                    <th>属性名称</th>
                    <th>属性类型</th>
                    <th>录入方式</th>
                    <th>商品类型</th>
                    <th>属性值</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php if(is_array($attrs) || $attrs instanceof \think\Collection || $attrs instanceof \think\Paginator): if( count($attrs)==0 ) : echo "" ;else: foreach($attrs as $key=>$attr): ?>
                <tr>
                    <td>
                        <input name="" type="checkbox" value="" />
                    </td>
                    <td><?php echo $key+1; ?></td>
                    <td><?php echo $attr['attr_name']; ?></td>
                    <td><?php echo config('attr_type')[$attr['attr_type']]; ?></td>
                    <td><?php echo config('attr_input_type')[$attr['attr_input_type']]; ?></td>
                    <td><?php echo $attr['type_name']; ?></td>
                    <td><?php echo $attr['attr_values']; ?></td>
                    <td><a href="<?php echo url('/admin/attribute/upd',['attr_id'=>$attr['attr_id']]); ?>" class="tablelink">编辑</a> <a href="<?php echo url('/admin/attribute/del',['attr_id'=>$attr['attr_id']]); ?>" onclick="return confirm('确定要删除吗？');" class="tablelink"> 删除</a></td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
        <div class="pagination">
        </div>
        <div class="tip">
            <div class="tiptop"><span>提示信息</span>
                <a></a>
            </div>
            <div class="tipinfo">
                <span><img src="<?php echo config('static_admin'); ?>/images/ticon.png" /></span>
                <div class="tipright">
                    <p>是否确认对信息的修改 ？</p>
                    <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
                </div>
            </div>
            <div class="tipbtn">
                <input name="" type="button" class="sure" value="确定" />&nbsp;
                <input name="" type="button" class="cancel" value="取消" />
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('.tablelist tbody tr:odd').addClass('odd');
    </script>
</body>

</html>