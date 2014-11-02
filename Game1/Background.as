package  {
	
	import flash.display.MovieClip;
	import flash.events.Event;
    import flash.events.KeyboardEvent;
    import flash.ui.Keyboard
	
	public class Background extends MovieClip {
		var speed;
		
		public function Background() {
			// constructor code
			this.addEventListener(Event.ENTER_FRAME, onEnter);
			speed = 5;
		}
		
		function onEnter(e:Event):void
		{
			this.x = this.x - speed;
			if(this.x < -2110)
			{
				this.x = 0;
			}
		}
	}
	
}
