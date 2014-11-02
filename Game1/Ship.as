package 
{
	
	import flash.display.MovieClip;
	import flash.events.Event;
    import flash.events.KeyboardEvent;
    import flash.ui.Keyboard;
	import flash.display.Sprite;
	
	public class Ship extends MovieClip 
	{
		//addEventListener(KeyboardEvent.KEY_DOWN, onKeyDown);
		//addEventListener(KeyboardEvent.KEY_UP, onKeyUp);
		var velocity;
		var leftKeyDown:Boolean = false;
		var upKeyDown:Boolean = false;
		var rightKeyDown:Boolean = false;
		var downKeyDown:Boolean = false;
		var spaceKeyDown:Boolean = false;
		var shootLimiter;
		var enemyTimer;
		//var missle;
		public function Ship() 
		{
			// constructor code
		    // this.addEventListener(KeyboardEvent.KEY_UP, moveShip);
			this.addEventListener(Event.ENTER_FRAME, onEnter);
			stage.addEventListener(KeyboardEvent.KEY_DOWN,checkKeyDown); 
			stage.addEventListener(KeyboardEvent.KEY_UP,checkKeyUp);
			velocity = 10;
			shootLimiter = 0
			enemyTimer = 0;
		
			
		}
		
    
	function onEnter(e:Event):void 
	{
		
		if(rightKeyDown)
		{
			this.x = this.x + velocity;
			
		}
		if(leftKeyDown)
		{
			this.x = this.x - velocity;
		}
		if(downKeyDown)
		{
			this.y = this.y + velocity;
		}
		if(upKeyDown)
		{
			this.y = this.y - velocity;
		}
		
		//spawn enimies
		enemyTimer += 1;
		if(enemyTimer > 60)
		{
			var enemy:Enemy = new Enemy();
			//enemy.width = 100;
			//enemy.height = 100;
			
			stage.addChild(enemy);
			enemyTimer = 0;
			
		
		}
	}
    
   
	function reportKeyDown(event:KeyboardEvent):void 
	{ 
		trace(event.currentTarget.name + " hears key press: " + String.fromCharCode(event.charCode) + " (key code: " +         event.keyCode + " character code: " + event.charCode + ")"); 
	}
	
	function checkKeyDown(e:KeyboardEvent):void 
	{
		if(e.keyCode == Keyboard.RIGHT)
		{
			rightKeyDown=true;
			
		}
		if(e.keyCode == Keyboard.LEFT)
		{
			leftKeyDown=true;
		}
		if( e.keyCode == Keyboard.DOWN)
		{
			downKeyDown=true;
		}
		if( e.keyCode == Keyboard.UP )
		{
			upKeyDown=true;
		}
		if( e.keyCode == Keyboard.SPACE)
		{
			spaceKeyDown=true;
			var missle:Missle = new Missle();
			missle.width = 100;
			missle.height = 20;
			missle.x = this.x + 190;
			missle.y = this.y + 33;
			
			stage.addChild(missle);
			
			
		}
		
	
	}	
	function checkKeyUp(e:KeyboardEvent):void 
	{
		if(e.keyCode == Keyboard.RIGHT)
		{
			rightKeyDown=false;
			
		}
		if(e.keyCode == Keyboard.LEFT)
		{
			leftKeyDown=false;
		}
		if( e.keyCode == Keyboard.DOWN)
		{
			downKeyDown=false;
		}
		if( e.keyCode == Keyboard.UP )
		{
			upKeyDown=false;
		}
		if( e.keyCode == Keyboard.SPACE )
		{
			spaceKeyDown=true;
		}
	
	}	 
	
	}
	
}
