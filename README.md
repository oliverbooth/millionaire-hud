# URL parameters

All parameters are optional.

|Name|Type|Default|Description|
|- |- |- |- |
|text|`string`||The text to display over the graphic.|
|size|`int`|15|The font size (in points).|
|font|`string`|ARIAL|The font filename. The font must be .TTF and the filename and extension must be uppercase.|
|n|`int`|1|The image variant.|
|k|`char`||The image subvariant.|

Examples:
```
?text=Hello&size=12

?text=World&n=4&k=c
```