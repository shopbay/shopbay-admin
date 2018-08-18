<?php
/**
 * This file is part of Shopbay.org (http://shopbay.org)
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * Description of PlansControllerTrait
 *
 * @author kwlok
 */
trait PlansControllerTrait 
{
    private $_dataProvider;
    protected $submitUrl;
    protected $apiRoute;
    /**
     * @inheritdoc
     * @see SPageIndexController
     */
    public function getDataProvider($scope,$searchModel=null)
    {
        $this->run('prepareIndex');
        if (isset($this->_dataProvider)){
            return $this->_dataProvider;
        }
        else
            return new CArrayDataProvider([]);//empty data
    } 
    
    public function prepareDataProvider($items, $pagination, $links)
    {
        $this->_dataProvider = new ApiDataProvider($items,[
            'keyField'=>false,
            'sort'=>false,
            'pagination'=>$pagination,                
            'totalCount'=>$pagination->getItemCount(),
        ]);  
        return $this->_dataProvider;
    }
    /**
     * Return page menu (with auto active class)
     * @param type $model
     * @return type
     */
    public function getPageMenu($model)
    {
        return [
            ['id'=>'view','title'=>Sii::t('sii','View {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','view'),  'url'=>$model->viewUrl,'linkOptions'=>['class'=>$this->action->id=='view'?'active':'']],
            ['id'=>'create','title'=>Sii::t('sii','Create {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','create'), 'url'=>['create']],
            ['id'=>'update','title'=>Sii::t('sii','Update {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','update'), 'url'=>['update', 'id'=>$model->id],'visible'=>$model->updatable(user()->getId(),true),'linkOptions'=>['class'=>$this->action->id=='update'?'active':'']],
            ['id'=>'delete','title'=>Sii::t('sii','Delete {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','delete'), 'visible'=>$model->deletable(user()->getId(),true), 
                    'linkOptions'=>[
                        'submit'=>['delete','id'=>$model->id],
                        'onclick'=>'$(\'.page-loader\').show();',
                        'confirm'=>Sii::t('sii','Are you sure you want to delete this {object}?',['{object}'=>strtolower($model->displayName())]),
                    ]
            ],
            ['id'=>'submit','title'=>Sii::t('sii','Submit {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','submit'), 'visible'=>$model->submitable(user()->getId(),true), 
                    'linkOptions'=>[
                        'submit'=>url($this->submitUrl,[get_class($model).'[id]'=>$model->id]),
                        'onclick'=>'$(\'.page-loader\').show();',
                        'confirm'=>Sii::t('sii','Are you sure you want to submit this {object}?',['{object}'=>strtolower($model->displayName())]),
                    ],
            ],
            ['id'=>'subscribe','title'=>Sii::t('sii','Subscribe {object}',['{object}'=>$model->displayName()]),'subscript'=>Sii::t('sii','subscribe'), 'url'=>['subscribe', 'plan'=>$model->id],'visible'=>$model->isInternal,'linkOptions'=>['class'=>$this->action->id=='subscribe'?'active':'']],
        ];
    } 
    /**
     * OVERRIDE METHOD
     * @see SPageIndexController
     * @return array
     */
    public function getScopeFilters()
    {
        $filters = new CMap();
        $filters->add('all',Helper::htmlIndexFilter('All', false));
        return $filters->toArray();
    }      
}
