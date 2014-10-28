## InstagramWidget

InstagramWidget is an Extra to display your Instagram photos, other users photos, hashtagged photos, user statistics on your website. 
Make a gallery from Instagram photos, properties are customizable with wrapper and row tpl chunks. Demo on http://inwidget.com/

## Registration
Go to http://instagram.com/developer/clients/manage
Register New Client
copy Client ID

## How it Works
simple call 
[[InstagramWidget? &id=`12345instagramID6789` &login=`instagram_login`]]
will display photos from user.


## Properties configuration

(required)
&id = `12345instagramID6789` required - don't use default on production it can be blocked by Instagram API.
&login =`login` required if you don't use hashtag property option.

(optional)
&hashtag = `modx` will get hashtagged photos from Instagram. Not user related.
&random =`1` random photos or last photos
&cacheExpTime = `6` cache time in hours

(templating default)
&width =`260px` widget width, could be number with 'px', or number with '%'.
&imageSize = `small` imagesize from Instagram used for thumbnails  'small', 'large', 'fullsize'.
&limit = `12` limit of retrieved and displayed images.
&inLine = `6` number of images in line

(templating advanced)
&cssFile = `/components/instagramwidget/css/instagramwidget.css` widget css file, use blank if you use custom styles and templating.
&wrapper = `tpl.Instagram.Widget.wrapper` wrapper tpl for widget.
&tpl = `tpl.Instagram.Widget.row` row tpl for widget.


## Information

This extra based on 
	inWidget - free Instagram widget for your site!
	http://inwidget.ru
	© Alexandr Kazarmshchikov

## Copyright Information

InstagramWidget is distributed as GPL (as MODx Revolution is), but the copyright owner
grants all users of InstagramWidget the ability to modify, distribute
and use InstagramWidget as they see fit, as long as attribution
is given somewhere in the distributed source of all derivative works. 