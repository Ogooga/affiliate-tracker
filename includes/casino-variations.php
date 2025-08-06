<?php
/**
 * Casino Variations - Helper functions for casino slug and title variations
 *
 * @package Affiliate_Tracker
 */

$casino_variants = [
    "32 roșu" => "32rosu",
    "32 rosu" => "32rosu",
    "32 ROȘU" => "32rosu",
    "32 ROSU" => "32rosu",
    "32 Roșu" => "32rosu",
    "32 Rosu" => "32rosu",
    "32roșu" => "32rosu",
    "32rosu" => "32rosu",
    "32ROȘU" => "32rosu",
    "32ROSU" => "32rosu",
    "32Roșu" => "32rosu",
    "32Rosu" => "32rosu",
    "roșu 32" => "32rosu",
    "rosu 32" => "32rosu",
    "ROȘU 32" => "32rosu",
    "ROSU 32" => "32rosu",
    "Roșu 32" => "32rosu",
    "Rosu 32" => "32rosu",
    "roșu32" => "32rosu",
    "rosu32" => "32rosu",
    "ROȘU32" => "32rosu",
    "ROSU32" => "32rosu",
    "Roșu32" => "32rosu",
    "Rosu32" => "32rosu",

    // Full phrase variations (normalize to 'conti')
    "conti cazino" => "conti",
    "CONTI CAZINO" => "conti",
    "Conti Cazino" => "conti",
    "conticazino" => "conti",
    "CONTICAZINO" => "conti",
    "ContiCazino" => "conti",
    "cazino conti" => "conti",
    "CAZINO CONTI" => "conti",
    "Cazino Conti" => "conti",
    "cazinoconti" => "conti",
    "CAZINOCONTI" => "conti",
    "CazinoConti" => "conti",
    // Single word variations (also normalize to 'conti')
    "conti" => "conti",
    "CONTI" => "conti",
    "Conti" => "conti",

    // Normal order
    "las vegas" => "lasvegas",
    "LAS VEGAS" => "lasvegas",
    "Las Vegas" => "lasvegas",
    "lasvegas" => "lasvegas",
    "LASVEGAS" => "lasvegas",
    "LasVegas" => "lasvegas",

    // Reversed order
    "vegas las" => "lasvegas",
    "VEGAS LAS" => "lasvegas",
    "Vegas Las" => "lasvegas",
    "vegaslas" => "lasvegas",
    "VEGASLAS" => "lasvegas",
    "VegasLas" => "lasvegas",

    // Normal order
    "mozzart bet" => "mozzart",
    "MOZZART BET" => "mozzart",
    "Mozzart Bet" => "mozzart",
    "mozzartbet" => "mozzart",
    "MOZZARTBET" => "mozzart",
    "MozzartBet" => "mozzart",

    // Reversed order
    "bet mozzart" => "mozzart",
    "BET MOZZART" => "mozzart",
    "Bet Mozzart" => "mozzart",
    "betmozzart" => "mozzart",
    "BETMOZZART" => "mozzart",
    "BetMozzart" => "mozzart",

    // Single-word variants (only for Mozzart)
    "mozzart" => "mozzart",
    "MOZZART" => "mozzart",
    "Mozzart" => "mozzart",

    // Fortuna Palace variants
    "fortuna palace" => "fortunapalace",
    "FORTUNA PALACE" => "fortunapalace",
    "Fortuna Palace" => "fortunapalace",
    "fortunapalace" => "fortunapalace",
    "FORTUNAPALACE" => "fortunapalace",
    "FortunaPalace" => "fortunapalace",

    // Ultrabet
    "ultrabet" => "ultrabet",
    "ULTRABET" => "ultrabet",
    "Ultrabet" => "ultrabet",

    // MaxWin
    "maxwin" => "maxwin",
    "MAXWIN" => "maxwin",
    "MaxWin" => "maxwin",
    "max win" => "maxwin",
    "MAX WIN" => "maxwin",
    "Max Win" => "maxwin",

    // Princess
    "princess" => "princess",
    "PRINCESS" => "princess",
    "Princess" => "princess",

    // VivaBet
    "vivabet" => "vivabet",
    "VIVABET" => "vivabet",
    "VivaBet" => "vivabet",
    "viva bet" => "vivabet",
    "VIVA BET" => "vivabet",
    "Viva Bet" => "vivabet",

    // Admiralbet
    "admiralbet" => "admiralbet",
    "ADMIRALBET" => "admiralbet",
    "Admiralbet" => "admiralbet",

    // Prima
    "prima" => "prima",
    "PRIMA" => "prima",
    "Prima" => "prima",

    // TotoGaming
    "totogaming" => "totogaming",
    "TOTOGAMING" => "totogaming",
    "TotoGaming" => "totogaming",
    "toto gaming" => "totogaming",
    "TOTO GAMING" => "totogaming",
    "Toto Gaming" => "totogaming",

    // Pokerstars
    "pokerstars" => "pokerstars",
    "POKERSTARS" => "pokerstars",
    "Pokerstars" => "pokerstars",
    "poker stars" => "pokerstars",
    "POKER STARS" => "pokerstars",
    "Poker Stars" => "pokerstars",

    // Mr Bit
    "mr bit" => "mrbit",
    "MR BIT" => "mrbit",
    "Mr Bit" => "mrbit",
    "mrbit" => "mrbit",
    "MRBIT" => "mrbit",
    "MrBit" => "mrbit",

    // Betfair
    "betfair" => "betfair",
    "BETFAIR" => "betfair",
    "Betfair" => "betfair",

    // Player
    "player" => "player",
    "PLAYER" => "player",
    "Player" => "player",

    // PariuriPlus
    "pariuriplus" => "pariuriplus",
    "PARIURIPLUS" => "pariuriplus",
    "PariuriPlus" => "pariuriplus",
    "pariuri plus" => "pariuriplus",
    "PARIURI PLUS" => "pariuriplus",
    "Pariuri Plus" => "pariuriplus",

    // Lucky Seven
    "lucky seven" => "luckyseven",
    "LUCKY SEVEN" => "luckyseven",
    "Lucky Seven" => "luckyseven",
    "luckyseven" => "luckyseven",
    "LUCKYSEVEN" => "luckyseven",
    "LuckySeven" => "luckyseven",

    // TotalBet
    "totalbet" => "totalbet",
    "TOTALBET" => "totalbet",
    "TotalBet" => "totalbet",
    "total bet" => "totalbet",
    "TOTAL BET" => "totalbet",
    "Total Bet" => "totalbet",

    // One
    "one" => "one",
    "ONE" => "one",
    "One" => "one",

    // Manhattan
    "manhattan" => "manhattan",
    "MANHATTAN" => "manhattan",
    "Manhattan" => "manhattan",

    // Game World
    "game world" => "gameworld",
    "GAME WORLD" => "gameworld",
    "Game World" => "gameworld",
    "gameworld" => "gameworld",
    "GAMEWORLD" => "gameworld",
    "GameWorld" => "gameworld",

    // Luck
    "luck" => "luck",
    "LUCK" => "luck",
    "Luck" => "luck",

    // Favbet
    "favbet" => "favbet",
    "FAVBET" => "favbet",
    "Favbet" => "favbet",

    // Million
    "million" => "million",
    "MILLION" => "million",
    "Million" => "million",

    // Frank
    "frank" => "frank",
    "FRANK" => "frank",
    "Frank" => "frank",

    // Excelbet
    "excelbet" => "excelbet",
    "EXCELBET" => "excelbet",
    "Excelbet" => "excelbet",

    // Superbet
    "superbet" => "superbet",
    "SUPERBET" => "superbet",
    "Superbet" => "superbet",

    // Getsbet
    "getsbet" => "getsbet",
    "GETSBET" => "getsbet",
    "Getsbet" => "getsbet",

    // Fortuna
    "fortuna" => "fortuna",
    "FORTUNA" => "fortuna",
    "Fortuna" => "fortuna",

    // Elite Slots
    "elite slots" => "eliteslots",
    "ELITE SLOTS" => "eliteslots",
    "Elite Slots" => "eliteslots",
    "eliteslots" => "eliteslots",
    "ELITESLOTS" => "eliteslots",
    "EliteSlots" => "eliteslots",

    // PublicWin
    "publicwin" => "publicwin",
    "PUBLICWIN" => "publicwin",
    "PublicWin" => "publicwin",

    // HotSpins
    "hotspins" => "hotspins",
    "HOTSPINS" => "hotspins",
    "HotSpins" => "hotspins",
    "hot spins" => "hotspins",
    "HOT SPINS" => "hotspins",
    "Hot Spins" => "hotspins",

    // Don
    "don" => "don",
    "DON" => "don",
    "Don" => "don",

    // BetMen
    "betmen" => "betmen",
    "BETMEN" => "betmen",
    "BetMen" => "betmen",
    "bet men" => "betmen",
    "BET MEN" => "betmen",
    "Bet Men" => "betmen",

    // Cashpot
    "cashpot" => "cashpot",
    "CASHPOT" => "cashpot",
    "Cashpot" => "cashpot",

    // Betano
    "betano" => "betano",
    "BETANO" => "betano",
    "Betano" => "betano",

    // Bet7
    "bet7" => "bet7",
    "BET7" => "bet7",
    "Bet7" => "bet7",

    // 888
    "888" => "888",

    // Vlad
    "vlad" => "vlad",
    "VLAD" => "vlad",
    "Vlad" => "vlad",

    // Lady
    "lady" => "lady",
    "LADY" => "lady",
    "Lady" => "lady",

    // Victory
    "victory" => "victory",
    "VICTORY" => "victory",
    "Victory" => "victory",

    // Winbet
    "winbet" => "winbet",
    "WINBET" => "winbet",
    "Winbet" => "winbet",

    // Pariurilor
    "pariurilor" => "pariurilor",
    "PARIURILOR" => "pariurilor",
    "Pariurilor" => "pariurilor",

    // Powerbet
    "powerbet" => "powerbet",
    "POWERBET" => "powerbet",
    "Powerbet" => "powerbet",
    "power bet" => "powerbet",
    "POWER BET" => "powerbet",
    "Power Bet" => "powerbet",

    // Winmasters
    "winmasters" => "winmasters",
    "WINMASTERS" => "winmasters",
    "Winmasters" => "winmasters",
    "win masters" => "winmasters",
    "WIN MASTERS" => "winmasters",
    "Win Masters" => "winmasters",

    // Spin
    "spin" => "spin",
    "SPIN" => "spin",
    "Spin" => "spin",

    // Maxbet
    "maxbet" => "maxbet",
    "MAXBET" => "maxbet",
    "Maxbet" => "maxbet",

    // Netbet
    "netbet" => "netbet",
    "NETBET" => "netbet",
    "Netbet" => "netbet",

    // Seven
    "seven" => "seven",
    "SEVEN" => "seven",
    "Seven" => "seven",

    // Royal
    "royal" => "royal",
    "ROYAL" => "royal",
    "Royal" => "royal",

    // Winner
    "winner" => "winner",
    "WINNER" => "winner",
    "Winner" => "winner",

    // Stanleybet
    "stanleybet" => "stanleybet",
    "STANLEYBET" => "stanleybet",
    "Stanleybet" => "stanleybet",
    "stanley bet" => "stanleybet",
    "STANLEY BET" => "stanleybet",
    "Stanley Bet" => "stanleybet",

    // Magic
    "magic" => "magic",
    "MAGIC" => "magic",
    "Magic" => "magic",

    // PlayGG
    "playgg" => "playgg",
    "PLAYGG" => "playgg",
    "PlayGG" => "playgg",
    "play gg" => "playgg",
    "PLAY GG" => "playgg",
    "Play GG" => "playgg",

    // Win2
    "win2" => "win2",
    "WIN2" => "win2",
    "Win2" => "win2",

    // MagnumBet
    "magnumbet" => "magnumbet",
    "MAGNUMBET" => "magnumbet",
    "MagnumBet" => "magnumbet",
    "magnum bet" => "magnumbet",
    "MAGNUM BET" => "magnumbet",
    "Magnum Bet" => "magnumbet",

    // SlotV
    "slotv" => "slotv",
    "SLOTV" => "slotv",
    "SlotV" => "slotv",
    "slot v" => "slotv",
    "SLOT V" => "slotv",
    "Slot V" => "slotv",

    // Unibet
    "unibet" => "unibet",
    "UNIBET" => "unibet",
    "Unibet" => "unibet",

    // Platinum
    "platinum" => "platinum",
    "PLATINUM" => "platinum",
    "Platinum" => "platinum"
];