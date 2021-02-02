# corp
A board game about climbing ladders

Saw a reddit post about a board game.

https://sysifuscorp.com/
https://www.reddit.com/user/Xcellion/
https://www.facebook.com/sysifuscorp/
https://www.kickstarter.com/projects/pegasusgamesnyc/welcome-to-sysifus-corp-a-cut-throat-corporate-board-game


composer install
"./vendor/bin/phpunit" tests

php 7.4
composer 2
phpunit 9
Apache Webserver?

Project Done:
TDD infrastructure

Project Path:
API tests
Frontend tests
API!
Single player - winning! - Client side
Add Memos
Add Politics
Add Certs
Multi player hotseat
Save game server side
Record play history
Multi player online
Multi player with ai
Resume saved games
private games
Invite url
Stats
Disconnect ai take over
Chat?

Game components/rules
**************

Certificates

Red Single Use

All other players lose note
All other players discard politics card at random
All other players return 2 projects to the bottom of the deck
All other players lose 3 influence

Green Once per work day
After drawing take back one office politic card you discarded this day
Copy effects of other green cert
Flip a cert back up for each player - maybe used again(even if says use once)
Gain back influence or office politics you used to pay for a card

Blue use once
One extra work day token for research only, return after use
One extra work day token for placing only, return after use
One extra work day token for moving only, return after use
Get a sticky note, you can't have more than 1 still

Projects
Value
6 x 0 left, right, bottom, bottom-left, bottom-right

10 x 1 bottom, bottom-left, bottom-right

5 x 2 left, bottom, bottom-left

4 x 3 bottom, bottom-left

Politics 4 of each - 40(4x10) in each game, pick before starting (100 total)

Green

Call in Favor
i 1 put an empty project back in your hand or to the bottom of the deck 1 away
?i x further away

Reschedule the meeting
i 1 Swap a tile in your hand for one that is 1 away, do not gain i
?i x further away
p 1 swap the tile you are on instead

Extend a deadline
i 1 move an unoccupied tile next to you to empty space 1 space away
?i move by x more tiles
2 p tile can be occupied, move the occupant as well

Spread a rumor
i 1 Rotate a tile that is 1 away
?i x further away
p 1 the tile you are on instead

Belittle the competition
i 1 swap tile 1 away with ajasent tile, you may not be on it, move players with tiles
?i x Further away
2 p you can be on the swapped tiles

Restructure priorities
i 1 Move a tile 1 away with an empty tile 1 away, move players with tile
?i Move a tile x further away
2p Move the tile you are on intead

Establish a clique
i 2 pick 2 tiles that are both 1 away and swap positions(not rotation) Move the players
?i Swap extra x tiles
2p You can change orientations

Reorganize Checklist
i 1 shift a row of unoccupied tiles by 1
?i shift further x rows
2p can be occupied

Move up a deadline
i 1 Pick up unoccupied 1 away tile and move it next to you
?i x further away
2p Can be occupied


Yellow

fan flames
i 1 Choose a politics you used today and keep it
?i keep X more politics 

Go through old files
i 1 Draw politic from top of discard
?i draw x more
1p From anywhere in discard

Stand in from someone
Reveal this card, now counts for 2 politic card cost

Pick favorites
For the workday you can use projects instead of politic cards to pay for politic cards

Trade meeting notes
i 1 take random politics from other player, give 1 back
?i x more cards
1p Look at hand before taking card

Develop your social skills
i 3 FOr this work day all politic cards cost one less politics
1p for this work day all politic cards cost one less i


Red

Report to HR
Reveal and cancel another poltics card at anytime. Cost is refunded.

Insert your own opinion
Reveal and cancel non reactive(red) card at anytime. Cost is refunded. You may then use one of your politics cards even if it isn't your turn.

Raise criticisms
Reveal and disard when player moved to a project. Player does not get influence.

Pass the blame
Reveal when non reactive(red) card played at anytime. Select player that isn't you to decide how the card is used. Original player, pays costs.


Blue

Suck up to seniors
3 i p 1 Your next move ignores sticky notes
?i ?p add +1 for each i and p

Work overtime (non addons)
i 1 + 1 place this work day
i 2 + 1 research this work day
i 3 p 1 + 1 move this work day
i 5 + p 1 + 2 hours this work day

Volunteer co-workers
i 2 Move all other players once. Players gain i.
+ i 2 - + 1 move
+ p 2 - Ignore sticky notes

Throw under bus
i 0 All other players lose 1 i
?i add x i lost
?p 1 p lost at random per p

Steal the credit
i 2 + p 2 - Swap positions with player 1 tile away, do not gain i
?i + ?p - x tiles further away

Wait out the debate (This is formatted oddly)
Discard this and x other politic cards.
Gain x + 1 i


1 post it note max
5 influence max
3 work hours per turn
Draw back up to 3 politic cards
Draw back up to 2 project cards

Winner: Visit all bosses and return back to start.

Goes first: Least unoppened emails private or work.(random?)

5 x 5 grid
1 corner start/end
Other corners Bosses
Bottom left red.
Top left green.
Top right blue.
Bottom right start/end.

Memo purchased for 1 work hour

if project card altered, memo token removed

Upto 4 players

Show game rules
