# RaidBillBoard
Billboard to show active raids sorted by which raids will end first

# Install
```
git clone https://github.com/Zyahko/RealDeviceMap-RaidBillBoard
cp raid.php to your directory root for your site (i.e. /var/www/site/)
```
# raid.php
Configure the database variables to match what is needed to access your RealDeviceMap Database
You can alter the column names by changing what is between the <th></th> tags

# create_pokedex.sql
Run this sql statement on your RealDeviceMap database to create the table that the billboard will use to match the raid_pokemon_id to pokemon_id to pull the pokemon's name instead of showing the ID. Should be able to use "source create_pokedex.sql" or copy and paste it into mysql prompt

# create_quick_movedex.sql
Run this to create a table for the raid boss quick move just like you would for the create_pokedex.sql

# create_charge_movedex.sql
Run this to create a table for the raid boss charge move just like you would for the create_pokedex.sql

# TO-DO
- Add Gym Owner/Team
- ~~Add Raid Boss Moveset~~
- ~~Add gps link to gym name~~

# Thanks
- Credit to SkOODaT for the geofence syntax for the sql statement and the refresh page code
- Credit to CRAKD for the google maps hyperlink to the gym name
