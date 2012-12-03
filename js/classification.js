/* 0-red 1-orange 2-yellow 3-green 4-cyans 5-blue 6-magnentass 7-black&white&grey */

function colorClassification(dominalcolor)
{
var	saturation=getSaturation(dominalcolor[0],dominalcolor[1],dominalcolor[2]);
var colorType,lightness,hue;
		
		if (saturation<=0.1)
		{
			colorType=7;
		}
		else
		{
		    lightness=getLightness(dominalcolor[0],dominalcolor[1],dominalcolor[2]);
		    if (lightness>=0.95 || lightness<=0.15)
		    {
		    	colorType=7;
		    }
		    else
		    {
		    	hue=getHue(dominalcolor[0],dominalcolor[1],dominalcolor[2]);
		    	colorType=classifyHue(hue);
		    }	
		}
   
   return colorType;      
}
	
	
function getSaturation(r,g,b)
{
var maxRGB=Math.max(r,g,b)/255;
var minRGB=Math.min(r,g,b)/255;
var lightness=getLightness(r,g,b);
    
    if (maxRGB+minRGB==0 || maxRGB==minRGB)
    {
    	saturation=0;
    }
    else if (lightness>0 && lightness<=0.5)
    {
    	saturation=(maxRGB-minRGB)/(2*lightness);
    }
    else
    {
    	saturation=(maxRGB-minRGB)/(2-2*lightness);
    }
   
   return saturation;
}
	
	
function getLightness(r,g,b)
{
var lightness=(Math.max(r,g,b)+Math.min(r,g,b))/(2*255);
	return lightness;
}
	
function getHue(r,g,b)
  var hue;
  var maxRGB = Math.max(r,g,b);
  var minRGB = Math.min(r,g,b);
    if(maxRGB == minRGB){
      hue = 0;
    } else {
      var d = maxRGB - minRGB;
      switch(maxRGB){
            case r: hue = (g - b) / d + (g < b ? 6 : 0); break;
            case g: hue = (b - r) / d + 2; break;
            case b: hue = (r - g) / d + 4; break;
            default: break;
        }
      var hue = hue * 60;
    }   
    return hue;
}

function classifyHue(hue)
{
	if (hue<25)
	{ return 0; }
	else if (hue<45)
	{ return 1; }
	else if (hue<75)
	{ return 2; }
	else if (hue<155)
	{ return 3; }
	else if (hue<190)
	{ return 4; }
	else if (hue<260)
	{ return 5; }
	else if (hue<330)
	{ return 6; }
	else
	{ return 0; } 
	
}