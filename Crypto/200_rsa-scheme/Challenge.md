# Crypto 200

>We found a server with an open port that apparently is able to decrypt numbers that
were encrypted with one certain public key. Our intelligence team was able to make this photo of the targets screen:

>	[Bild von encrypted flage, pub-key und N]

>Unfortunately we were caught in the act. While the team could escape we are not sure if the target changed anything on the server...  
>Connect to `Ip-Adresse`


###Lösung:  

Key 				| Value 					                |
------------------|----------------------------------------|
Public-Key 		| 48178053614270249105223164288953659473 |
Private-Key 		| 4467425933095040278527570182371257905  |
N 					| 53633566352303236952836378986267311063 |
Encrypted Flag 	| 31319528277563551791166984607206341790 |

Dem Dienst einfach:  

> **31319528277563551791166984607206341790 + 53633566352303236952836378986267311063**   

schicken. Durch die Addition ändert sich die Restklasse nicht, die Blacklist kann so umgangen werden.