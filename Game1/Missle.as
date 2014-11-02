package  {
	
	import flash.display.MovieClip;
	import flash.events.Event;
    import flash.events.KeyboardEvent;
    import flash.ui.Keyboard;
	import flash.display.Stage;
	public class Missle extends MovieClip {
		
		var speed;
		var stageRef:Stage;
		var spaceKeyDown:Boolean = false;
		public function Missle()
		{
			// constructor code
	
			this.addEventListener(Event.ENTER_FRAME, onEnter);
			//stage.addEventListener(KeyboardEvent.KEY_DOWN,checkKeyDown); 
			//stage.addEventListener(KeyboardEvent.KEY_UP,checkKeyUp);
			speed = 10;
		}
		function setStage(s:Stage):void 
		{
			stageRef = s;
		}
		
		function onEnter(e:Event):void
		{	
			this.x += speed;
			
			if(this.x > stage.width || this.x < 0 || this.y > stage.height || this.y < 0)
			{
				
				removeEventListener(Event.ENTER_FRAME, onEnter);
			 
				parent.removeChild(this); //remove the bullet
			}
		}
	
	}
	
}
