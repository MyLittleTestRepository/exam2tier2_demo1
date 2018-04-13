<?
AddEventHandler('main', 'OnBeforeEventAdd', array('EventHandler','feedback_author'));
class EventHandler
{
	function feedback_author( &$event, &$lid, &$arFields, &$message_id)
	{
		if($event!='FEEDBACK_FORM')
			return;
		
		global $USER;
		if(!$USER->IsAuthorized())
			$arFields['AUTHOR']='Пользователь не авторизован, данные из формы: '.$arFields['AUTHOR'];
		else
			$arFields['AUTHOR']='Пользователь авторизован: '.$USER->GetID().' ('.$USER->GetLogin().') '.$USER->GetFirstName().', данные из формы: '.$arFields['AUTHOR'];
		
		CEventLog::Log("INFO", "FEEDBACK_AUTHOR_REPLACE", "main", false, $arFields['AUTHOR']);
	}
}
?>