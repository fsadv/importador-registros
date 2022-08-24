<?php 
 //WARNING: The contents of this file are auto-generated


 // created: 2022-04-13 09:41:49
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['activities'] = array (
  'order' => 10,
  'sort_order' => 'desc',
  'sort_by' => 'date_due',
  'title_key' => 'LBL_ACTIVITIES_SUBPANEL_TITLE',
  'type' => 'collection',
  'subpanel_name' => 'activities',
  'module' => 'Activities',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateTaskButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopScheduleMeetingButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopScheduleCallButton',
    ),
    3 => 
    array (
      'widget_class' => 'SubPanelTopComposeEmailButton',
    ),
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForActivities',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_calls',
    ),
  ),
  'get_subpanel_data' => 'activities',
);
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['history'] = array (
  'order' => 20,
  'sort_order' => 'desc',
  'sort_by' => 'date_modified',
  'title_key' => 'LBL_HISTORY',
  'type' => 'collection',
  'subpanel_name' => 'history',
  'module' => 'History',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopCreateNoteButton',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopArchiveEmailButton',
    ),
    2 => 
    array (
      'widget_class' => 'SubPanelTopSummaryButton',
    ),
  ),
  'collection_list' => 
  array (
    'meetings' => 
    array (
      'module' => 'Meetings',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_meetings',
    ),
    'tasks' => 
    array (
      'module' => 'Tasks',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_tasks',
    ),
    'calls' => 
    array (
      'module' => 'Calls',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_calls',
    ),
    'notes' => 
    array (
      'module' => 'Notes',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_notes',
    ),
    'emails' => 
    array (
      'module' => 'Emails',
      'subpanel_name' => 'ForHistory',
      'get_subpanel_data' => 'rup_unidad_productiva_relevada_activities_1_emails',
    ),
  ),
  'get_subpanel_data' => 'history',
);


 // created: 2022-04-13 09:44:47
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['rup_unidad_productiva_relevada_documents_1'] = array (
  'order' => 100,
  'module' => 'Documents',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_RUP_UNIDAD_PRODUCTIVA_RELEVADA_DOCUMENTS_1_FROM_DOCUMENTS_TITLE',
  'get_subpanel_data' => 'rup_unidad_productiva_relevada_documents_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


 // created: 2022-08-18 14:04:35
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['gna_personas_grupo_asociativo_rup_unidad_productiva_relevada'] = array (
  'order' => 100,
  'module' => 'GNA_Personas_Grupo_Asociativo',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_GNA_PERSONAS_GRUPO_ASOCIATIVO_RUP_UNIDAD_PRODUCTIVA_RELEVADA_FROM_GNA_PERSONAS_GRUPO_ASOCIATIVO_TITLE',
  'get_subpanel_data' => 'gna_personas_grupo_asociativo_rup_unidad_productiva_relevada',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


 // created: 2022-08-18 14:59:17
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['gn_test_a_rup_unidad_productiva_relevada_1'] = array (
  'order' => 100,
  'module' => 'gn_test_a',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_GN_TEST_A_RUP_UNIDAD_PRODUCTIVA_RELEVADA_1_FROM_GN_TEST_A_TITLE',
  'get_subpanel_data' => 'gn_test_a_rup_unidad_productiva_relevada_1',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);


 // created: 2022-08-18 15:53:43
$layout_defs["RUP_Unidad_Productiva_Relevada"]["subpanel_setup"]['ga_grupo_asociativo_rup_unidad_productiva_relevada'] = array (
  'order' => 100,
  'module' => 'GA_Grupo_Asociativo',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_GA_GRUPO_ASOCIATIVO_RUP_UNIDAD_PRODUCTIVA_RELEVADA_FROM_GA_GRUPO_ASOCIATIVO_TITLE',
  'get_subpanel_data' => 'ga_grupo_asociativo_rup_unidad_productiva_relevada',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);

?>