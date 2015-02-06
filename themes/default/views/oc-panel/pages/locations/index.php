<?php defined('SYSPATH') or die('No direct script access.');?>

<div class="page-header">
    <a class="btn btn-primary pull-right ajax-load" href="<?=Route::url('oc-panel',array('controller'=>'location','action'=>'create'))?>" title="<?=__('New Location')?>">
        <?=__('New Location')?>
    </a>
    <h1><?=__('Locations')?></h1>
    <p><?=__("Change the order of your locations. Keep in mind that more than 2 levels nested probably won´t be displayed in the theme (it is not recommended).")?> <a href="http://open-classifieds.com/2013/08/22/how-to-add-locations/" target="_blank"><?=__('Read more')?></a></p>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading"><?=_('Home')?></div>
            <div class="panel-body">
                <ol class='plholder' id="ol_1" data-id="1">
                <?function lili($item, $key,$locs){?>
                
                    <li data-id="<?=$key?>" id="li_<?=$key?>"><i class="glyphicon   glyphicon-move"></i> <?=$locs[$key]['name']?>
                
                        <a 
                            href="<?=Route::url('oc-panel', array('controller'=> 'location', 'action'=>'delete','id'=>$key))?>" 
                            class="btn btn-xs btn-danger pull-right index-delete index-delete-inline" 
                            title="<?=__('Are you sure you want to delete? We will move the siblings locations and ads to the parent of this location.')?>" 
                            data-id="li_<?=$key?>" 
                            data-placement="left" 
                            data-href="<?=Route::url('oc-panel', array('controller'=> 'location', 'action'=>'delete','id'=>$key))?>" 
                            data-btnOkLabel="<?=__('Yes, definitely!')?>" 
                            data-btnCancelLabel="<?=__('No way!')?>">
                            <i class="glyphicon glyphicon-trash"></i>
                        </a>
                
                        <a class="btn btn-xs btn-primary pull-right ajax-load" title="<?=__('Edit')?>"
                            href="<?=Route::url('oc-panel',array('controller'=>'location','action'=>'update','id'=>$key))?>">
                            <?=__('Edit')?>
                        </a>
                
                        <ol data-id="<?=$key?>" id="ol_<?=$key?>">
                            <? if (is_array($item)) array_walk($item, 'lili', $locs);?>
                        </ol><!--ol_<?=$key?>-->
                
                    </li><!--li_<?=$key?>-->
                
                <?}array_walk($order, 'lili',$locs);?>
                </ol><!--ol_1-->
                
                <span id='ajax_result' data-url='<?=Route::url('oc-panel',array('controller'=>'location','action'=>'saveorder'))?>'></span>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-body">
                <span class="label label-info"><?=__('Heads Up!')?> <?=__('Quick location creator.')?></span>
                <div class="clearfix"></div> 
                <?=__('Add names for multiple locations, for each one push enter.')?>
                <div class="clearfix"></div><br>
              
                <?= FORM::open(Route::url('oc-panel',array('controller'=>'location','action'=>'multy_locations')), array('class'=>'form-inline', 'role'=>'form','enctype'=>'multipart/form-data'))?>
                    <div class="form-group">
                      <div class="">
                        <?= FORM::label('multy_locations', __('Name').':', array('class'=>'control-label', 'for'=>'multy_locations'))?>
                        <?= FORM::input('multy_locations', '', array('placeholder' => __('Hit enter to confirm'), 'class' => 'form-control', 'id' => 'multy_locations', 'type' => 'text','data-role'=>'tagsinput'))?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?= FORM::button('submit', __('Send'), array('type'=>'submit', 'class'=>'btn btn-primary', 'action'=>Route::url('oc-panel',array('controller'=>'location','action'=>'multy_locations'))))?>
                <?= FORM::close()?>
            </div>
        </div>
    </div>
</div>