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
$url = "https://jira.coinmarketrank.io/plugins/servlet/eazybi/accounts/3/export/report/92-slackbot.csv?embed_token=sxcelctjzjza0d0euj4rcdvh7kabf4hhhokv8hkjxtoghe3w67mqngqei18e";
$result = str_replace(","," | ",file_get_contents($url));
$result = str_replace("\n"," |\n| ",$result);
$result = "*CoinMarketRank* results for *TOP20:*\n".$result." More info in https://coinmarketrank.io \n";
echo $result;
?>