package  
{
	
	import flash.display.MovieClip;
	import flash.events.Event;
	
	public class Enemy extends MovieClip 
	{
		
		var speed;
		public function Enemy() 
		{
			// constructor codefunction onLoad()
			this.addEventListener(Event.ENTER_FRAME, onEnter);
			this.x = 700;
			this.y = Math.random()*300;
			speed = Math.random()*5 + 5;

		}
		function onEnter(e:Event):void
		{	
			this.x -= speed;
			if(this.x < -100)
			{
				
				removeEventListener(Event.ENTER_FRAME, onEnter);
			 
				parent.removeChild(this); 
			}
			
			if(theShip.hitTestObject(this))
			{
				removeEventListener(Event.ENTER_FRAME, onEnter);
			 
				parent.removeChild(this); //remove the bullet
			}
		}
	}
	
}
