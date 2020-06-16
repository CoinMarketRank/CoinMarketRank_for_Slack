<?php
$json = <<<JSON
{
   "response_type": "ephemeral",
   "text": "How to use /please",
   "attachments":[
       {
          "text":"To be fed, use `/please feed` to request food. We hear the elf needs food badly.\nTo tease, use `/please tease` &mdash; we always knew you liked noogies.\nYou've already learned how to get help with `/please help`."
       }
   ]
}
JSON;
//echo var_dump($_POST);
if ($_POST["text"] ) { echo "Run the command */top20* to know the TOP20 cryptocurrencies in markets, the prices and its changes from the web https://coinmarketrank.io . More commands will be added in the future. If you have some doubt, incidence or question please use this link https://jirasupport.atlassian.net/servicedesk/customer/portal/1/group/22/create/73";}
else {
$url = "https://jira.coinmarketrank.io/plugins/servlet/eazybi/accounts/3/export/report/92-slackbot.csv?embed_token=sxcelctjzjza0d0euj4rcdvh7kabf4hhhokv8hkjxtoghe3w67mqngqei18e";
$result = str_replace(","," | ",file_get_contents($url));
$result = str_replace("\n"," |\n| ",$result);
$result = "*CoinMarketRank* results for *TOP20:*\n".$result." More info in https://coinmarketrank.io \n";
echo $result;
}
?>
