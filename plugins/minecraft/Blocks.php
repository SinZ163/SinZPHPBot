<?php
class Blocks {
	public function getID($request) {
		$DB = array(
		1 => array("Stone", "Rock"),
		2 => 'Grass',
		3 => array("Dirt", "Earth"),
		4 => array("Cobblestone", "Cobble"),
		5 => array("WoodenPlank", "Wood", "Plank"),
		6 => 'Sapling',
		7 => array("Bedrock", "Adminium", "Solid"),
		8 => 'Water',
		9 => 'StationaryWater',
		10 => 'Lava',
		11 => 'StationaryLava',
        12 => 'Sand',
        13 => 'Gravel',
        14 => 'GoldOre',
        15 => 'IronOre',
        16 => 'CoalOre',
        17 => array("Log", "LogBlock"),
        '17:1' => array("PineLog", "RedwoodLog", "DarkLog"),
        '17:2' => 'BirchLog',
        18 => array("Leaves", "LeafBlock"),
        '18:1' => array("BirchLeaves", "BirchLeafBlock"),
        '18:2' => array("PineLeaves", "RedwoodLeaves", "DarkLeaves"),
        19 => 'Sponge',
        20 => 'Glass',
        21 => array("LapisLazuliOre", "LapisOre", "BlueOre"),
        22 => array("LapisLazuliBlock", "LapisBlock", "BlockOfLapis"),
        23 => 'Dispenser',
        24 => 'Sandstone',
        25 => array("Noteblock", "MusicBlock"),
        26 => 'BedBlock',
        27 => array("PoweredRail", "BoosterTrack", "BoosterRail"),
        28 => 'DetectorRail',
        29 => array("StickyPiston", "PushMePullYou"),
        30 => array("Web", "CobWeb", "SpiderWeb"),
        31 => array("DeadShrub", "Grass", "TallGrass"),
        '31:1' => 'TallGrass',
        '31:2' => 'Fern',
        32 => 'DeadShrub',
        33 => array("Piston", "PushMeNotPullYou"),
        34 => 'PistonHead',
        35 => array("Cloth", "Wool", "WoolBlock"),
        '35:1' => 'OrangeWool',
        '35:2' => array("MagentaWool", "PinkWool"),
        '35:3' => array("LightBlueWool", "BlueWool"),
        '35:4' => 'YellowWool',
        '35:5' => array("LimeWool", "LightGreenWool", "BrightGreenWool", "GreenWool"),
        '35:6' => array("PinkWool", "LightPinkWool"),
        '35:7' => array("DarkGreyWool", "DarkGrayWool", "GrayWool", "GreyWool"),
        '35:8' => array("LightGreyWool", "LightGrayWool", "GrayWool", "GreyWool"),
        '35:9' => array("AquaGreenWool", "AquaWool"),
        '35:10' => 'PurpleWool',
        '35:11' => array("BlueWool", "DarkBlueWool", "CyanWool"),
        '35:12' => 'BrownWool',
        '35:13' => array("GreenWool", "DarkGreenWool"),
        '35:14' => 'RedWool',
        '35:15' => 'BlackWool',
        36 => 'Nothing',
        37 => array("YellowFlower", "Flower"),
        38 => array("RedFlower", "Flower"),
        39 => array("BrownMushroom", "Mushroom"),
        40 => array("RedMushroom", "Mushroom", "1UP"),
        41 => 'GoldBlock',
        42 => 'IronBlock',
        43 => array("DoubleStep", "StoneStep"),
        '43:1' => array("SandstoneDoubleStep", "SandstoneStepBlock", "DoubleStep"),
        '43:2' => array("WoodDoubleStep", "DoubleStep"),
        '43:3' => array("CobblestoneDoubleStep", "CobbleDoubleStep", "DoubleStep"),
        43 => 'Step',
        '43:1' => array("SandstoneStep", "Step"),
        '43:2' => array("WoodStep", "Step"),
        '43:3' => array("CobbleStep", "Step"),
        45 => 'BrickBlock',
        46 => 'TNT',
        47 => 'Bookshelf',
        48 => array("MossyCobblestone", "MossyCobble", "MossStone"),
        49 => 'Obsidian',
        50 => 'Torch',
        51 => 'Fire',
        52 => array("MobSpawner", "Spawner"),
        53 => array("WoodStairs", "WoodenStairs"),
        54 => 'Chest',
        55 => 'RedstoneWire',
        56 => 'DiamondOre',
        57 => 'DiamondBlock',
        58 => array("Workbench", "CraftingBench"),
        59 => array("Seeds", "Wheat"),
        60 => 'Farmland',
        61 => 'Furnace',
        62 => array("Furnace(On)", "BurningFurnace"),
        63 => 'SignPost',
        64 => array("HalfWoodDoor", "HalfDoor"),
        65 => 'Ladder',
        66 => array("Rail", "MineTrack"),
        67 => array("CobbleStairs", "CobblestoneStairs"),
        68 => 'WallSign',
        69 => 'Lever',
        70 => 'StonePressurePlate',
        71 => array("HalfIronDoor", "HalfDoor"),
        72 => 'WoodPressurePlate',
        73 => 'RedstoneOre',
        74 => 'GlowingRedstoneOre',
        75 => 'RedstoneTorch(Off)',
        76 => array("RedstoneTorch", "RedstoneTorch(On)"),
        77 => 'Button',
        78 => 'Snow',
        79 => array("Ice", "IceBlock"),
        80 => 'SnowBlock',
        81 => 'Cactus',
        82 => array("ClayBlock", "Clay"),
        83 => 'ReedBlock',
        84 => array("Jukebox", "Musicbox"),
        85 => 'Fence',
        86 => 'Pumpkin',
        87 => 'Netherrack',
        88 => array("SoulSand", "SlowSand"),
        89 => array("Glowstone", "Lightstone"),
        90 => 'Portal',
        91 => array("Jack-O-Lantern", "JackOLantern"),
        92 => 'CakeBlock',
        93 => 'Repeater(Off)',
        94 => 'Repeater(On)',
        95 => array("MannCoSupplyCrate", "MannCoChest", "LockedChest", "SteveCoSupplyCreate", "SteveCo.SupplyCrate", "AprilFoolsChest", "SteveCoChest", "SteveCo.Chest", "LightEmittingBlockOfLightness"),
		96 => array('TrapDoor', 'Hatch'));
		256 => 'IronShovel',
		257 => array("IronPick", "IronPickaxe"),
		258 => 'IronAxe',
		259 => 'FlintAndSteel',
		260 => array("Apple", "RedApple"),
		261 => 'Bow',
		262 => 'Arrow',
		263 => array("Coal", "Charcoal"),
		264 => 'Diamond',
		265 => array("Iron", "IronIngot", "IronBar"),
		266 => array("Gold", "GoldIngot", "GoldBar"),
		267 => 'IronSword',
		268 => array("WoodSword", "WoodenSword"),
		269 => array("WoodShovel", "WoodenShovel"),
		270 => array("WoodPick", "WoodenPick", "WoodPickaxe", "WoodenPickaxe"),
		271 => array("WoodAxe", "WoodenAxe"),
		272 => 'StoneSword',
		273 => 'StoneShovel',
		274 => array("StonePick", "StonePickaxe"),
		275 => 'StoneAxe',
		276 => 'DiamondSword',
		277 => 'DiamondShovel',
		278 => array("DiamondPick", "DiamondPickaxe"),
		279 => 'DiamondAxe',
		280 => 'Stick',
		281 => 'Bowl',
		282 => array("MushroomSoup", "MushroomStew"),
		283 => 'GoldSword',
		284 => 'GoldShovel',
		285 => array("GoldPick", "GoldPickaxe"),
		286 => 'GoldAxe',
		287 => 'String',
		288 => 'Feather',
		289 => array("Gunpowder", "Sulphur", "Sulfur"),
		290 => array("WoodHoe", "WoodenHoe"),
		291 => 'StoneHoe',
		292 => 'IronHoe',
		293 => 'DiamondHoe',
		294 => 'GoldHoe',
		295 => 'Seeds',
		296 => 'Wheat',
		297 => 'Bread',
		298 => array("LeatherHelmet", "LeatherCap", "LeatherHelm"),
		299 => array("LeatherTunic", "LeatherChest", "LeatherChestplate"),
		300 => array("LeatherLeggings", "LeatherPants", "LeatherChaps"),
		301 => array("LeatherBoots", "LeatherShoes", "Moccasins"),
		302 => array("ChainHelmet", "ChainmaleHelmet"),
		303 => array("ChainChest", "ChainChestplate", "ChainmaleChest", "ChainmaleChestPlate"),
		304 => array("ChainLeggings", "ChainLegs", "ChainmaleLeggings", "ChaimaleLegs"),
		305 => array("ChainBoots", "ChainmaleBoots"),
		306 => array("IronHelm", "IronHelmet"),
		307 => array("IronChest", "IronChestplate"),
		308 => array("IronLegs", "IronLeggings"),
		309 => 'IronBoots',
		310 => array("DiamondHelm", "DiamondHelmet"),
		311 => array("DiamondChest", "DiamondChestplate"),
		312 => array("DiamondLegs", "DiamondLeggings"),
		313 => 'DiamondBoots',
		314 => array("GoldHelm", "GoldHelmet"),
		315 => array("GoldChest", "GoldChestplate"),
		316 => array("GoldLegs", "GoldLeggings"),
		317 => 'GoldBoots',
		318 => 'Flint',
		319 => array("UncookedPorkchop", "RawPorkchop"),
		320 => 'CookedPorkchop',
		321 => 'Painting',
		322 => array("GoldenApple", "GoldApple"),
		323 => 'Sign',
		324 => array("WoodDoor", "WoodenDoor"),
		325 => 'Bucket',
		326 => 'WaterBucket',
		327 => 'LavaBucket',
		328 => 'Minecart',
		329 => 'Saddle',
		330 => 'IronDoor',
		331 => array("Redstone", "RedstoneDust"),
		332 => 'Snowball',
		333 => 'Boat',
		334 => 'Leather',
		335 => array("MilkBucket", "Milk"),
		336 => 'Brick',
		337 => array("Clay", "ClayBall"),
		338 => array("SugarCane", "Reeds"),
		339 => 'Paper',
		340 => 'Book',
		341 => 'SlimeBall',
		342 => array("StorageMinecart", "StorageCart"),
		343 => array("PoweredMinecart", "PoweredCart"),
		344 => 'Egg',
		345 => 'Compass',
		346 => 'FishingRod',
		347 => array("Clock", "Watch"),
		348 => array("GlowstoneDust", "LightstoneDust"),
		349 => array("UncookedFish", "RawFish"),
		350 => 'CookedFish',
		351 => 'InkSac',
		'351:1' => 'RedDye',
		'351:2' => array("CactusGreen", "GreenDye", "CactusGreenDye"),
		'351:3' => 'BrownDye',
		'351:4' => array("LapisLazuli", "BlueDye"),
		'351:5' => 'PurpleDye',
		'351:6' => 'TealDye',
		'351:7' => array("LightGrayDye", "LightGreyDye", "GrayDye", "GreyDye"),
		'351:8' => array("DarkGrayDye", "DarkGreyDye", "GrayDye", "GreyDye"),
		'351:9' => array("LightPinkDye" "PinkDye"),
		'351:10' => array("LimeGreenDye", "GreenDye"),
		'351:11' => 'YellowDye',
		'351:12' => 'LightBlueDye',
		'351:13' => array("DarkPinkDye", "PinkDye"),
		'351:14' => 'OrangeDye',
		'351:15' => array("Bonemeal", "WhiteDye"),
		352 => 'Bone',
		353 => 'Sugar',
		354 => 'Cake',
		355 => 'Bed',
		356 => array("Repeater", "RedstoneRepeater"),
		357 => 'Cookie',
		358 => 'Map',
		359 => 'Shears',
		2256 => 'GoldRecord',
		2257 => 'GreenRecord',
		$block_name = strtolower($request);
		foreach ($DB as $id => $value) {
			if (!(is_array($value))) {
				if (strtolower($value) == $block_name) {
					$result = $id;
				}
			}
			else {
				foreach ($value as $value_array => $name) {
					if (strtolower($name) == $block_name)
						$result = $id;
				}
			}
		}
		return $result;
	}
	/*
		$DB = array();
		$ID_01 = array("Stone", "Rock");
		$ID_02 = array("Grass", "Earth");
		$ID_03 = array("Dirt", "Earth");
		$ID_04 = array("Cobblestone", "Cobble");
		$ID_05 = array("WoodenPlank", "Wood", "Plank");
		$ID_06 = array("Sapling");
		$ID_07 = array("Bedrock", "Adminium");
		$ID_08 = array("Water");
		$ID_09 = array("StationaryWater", "Water");
		$ID_10 = array("Lava");
		$ID_11 = array("StationaryLava", "Lava");
		$ID_12 = array("Sand");
		$ID_13 = array("Gravel");
		$ID_14 = array("GoldOre", "Gold");
		$ID_15 = array("IronOre", "Iron");
		$ID_16 = array("CoalOre", "Coal");
		$ID_17 = array("Log", "Trunk", "TreeTrunk", "Wood");
		$ID_18 = array("Leaves", "Leaf");
		$ID_19 = array("Sponge");
		$ID_20 = array("Glass", "Window");
		$ID_21 = array("LapisLazuliOre", "LapisLazuli");
		$ID_22 = array("LapisLazuliBlock");
		$ID_23 = array("Dispenser", "Trap");
		$ID_24 = array("Sandstone");
		$ID_25 = array("NoteBlock", "MusicBlock");
		$ID_26 = array("Bed");
		$ID_27 = array("PoweredRail");
		$ID_28 = array("DetectorRail", "PressureRail");
		$ID_29 = array();
		$ID_30 = array("Web", "Cobweb");
		$ID_31 = array("TallGrass", "WildGrass", "Shrubs");
		$ID_32 = array("DeadShrubs", "DesertShrubs");
		$ID_33 = array();
		$ID_34 = array();
		$ID_35 = array("Wool", "Cloth");
		$ID_36 = array();
		$ID_37 = array("Dandelion", "YellowFlower", "Flower", "YellowDandelion");
		$ID_38 = array("Rose", "RedFlower", "Flower", "RedRose");
		$ID_39 = array("BrownMushroom", "GreyMushroom", "DarkMushroom", "Mushroom");
		$ID_40 = array("RedMushroom", "LightMushroom", "Mushroom");
		$ID_41 = array("GoldBlock", "BlockOfGold");
		$ID_42 = array("IronBlock", "BlockOfIron");
		$ID_43 = array("Slab", "DoubleSlab");
		$ID_44 = array("Slab", "SingleSlab");
		$ID_45 = array("Brick", "BrickBlock");
		$ID_46 = array("TNT", "Dynamite", "Bomb");
		$ID_47 = array("Bookshelf", "Library");
		$ID_48 = array("MossStone", "MossyCobblestone");
		$ID_49 = array("Obsidian");
		$ID_50 = array("Torch", "Candle");
		$ID_51 = array("Fire");
		$ID_52 = array("MonsterSpawner", "MobSpawner");
		$ID_53 = array("WoodenStairs", "WoodStairs");
		$ID_54 = array("Chest", "Container");
		$ID_55 = array("Redstone", "RedstoneWire");
		$ID_56 = array("DiamondOre", "Diamond");
		$ID_57 = array("DiamondBlock", "BlockOfDiamond");
		$ID_58 = array("CraftingTable", "Workbench");
		$ID_59 = array("Seeds");
		$ID_60 = array("Farmland");
		$ID_61 = array("Furnace");
		$ID_62 = array("BurningFurnace", "Furnace");
		$ID_63 = array("Sign");
		$ID_64 = array("Door", "WoodenDoor", "WoodDoor");
		$ID_65 = array("Ladder");
		$ID_66 = array("Rail", "Rails", "Railway", "Track", "MinecartTrack", "CartTrack", "CartRail", "MinecartRail", "CartRails", "MinecartRails");
		$ID_67 = array("CobblestoneStairs", "StoneStairs", "Stairs");
		$ID_68 = array("Sign", "WallSign");
		$ID_69 = array("Lever", "Switch");
		$ID_70 = array("PressurePlate", "PressurePad", "StonePressurePlate", "StonePressurePad");
		$ID_71 = array("IronDoor", "Door");
		$ID_72 = array();
		$ID_73 = array("RedstoneOre", "Redstone");
		$ID_74 = array("RedstoneOre", "GlowingRedstoneOre", "Redstone");
		$ID_75 = array("RedstoneTorch");
		$ID_76 = array("RedstoneTorch");
		$ID_77 = array("Button", "StoneButton");
		$ID_78 = array("Snow", "SnowCap");
		$ID_79 = array("Ice");
		$ID_80 = array("Snow", "SnowBlock");
		$ID_81 = array("Cactus");
		$ID_82 = array("Clay", "ClayBlock");
		$ID_83 = array("SugarCane", "Reed");
		$ID_84 = array("Jukebox", "RecordPlayer");
		$ID_85 = array("Fence");
		$ID_86 = array("Pumpkin");
		$ID_87 = array("Netherrack", "Netherrock", "Netherstone");
		$ID_88 = array("SoulSand", "Quicksand", "Nethersand");
		$ID_89 = array("Glowstone", "GlowstoneBlock");
		$ID_90 = array("Portal", "NetherPortal");
		$ID_91 = array("JackOLantern", "GlowingPumpkin", "Pumpkin", "Jack'O'Lantern");
		$ID_92 = array("Cake");
		$ID_93 = array("RedstoneRepeater");
		$ID_94 = array("RedstoneRepeater", "RedstoneRepeaterOn");
		$ID_95 = array("LockedChest", "SteveCoSupplyCrate", "SteveCo.SupplyCrate", "AprilFoolsChest", "SteveCoChest", "SteveCo.Chest");
		$ID_96 = array("96", array("Trapdoor", "Hatch"));
		array_push($DB, $ID_01, $ID_02, $ID_03, $ID_04, $ID_05, $ID_06, $ID_07, $ID_08, $ID_09, $ID_10,
						$ID_11, $ID_12, $ID_13, $ID_14, $ID_15, $ID_16, $ID_17, $ID_18, $ID_19, $ID_20,
						$ID_21, $ID_22, $ID_23, $ID_24, $ID_25, $ID_26, $ID_27, $ID_28, $ID_29, $ID_30,
						$ID_31, $ID_32, $ID_33, $ID_34, $ID_35, $ID_36, $ID_37, $ID_38, $ID_39, $ID_40,
						$ID_41, $ID_42, $ID_43, $ID_44, $ID_45, $ID_46, $ID_47, $ID_48, $ID_49, $ID_50,
						$ID_51, $ID_52, $ID_53, $ID_54, $ID_55, $ID_56, $ID_57, $ID_58, $ID_59, $ID_60,
						$ID_61, $ID_62, $ID_63, $ID_64, $ID_65, $ID_66, $ID_67, $ID_68, $ID_69, $ID_70,
						$ID_71, $ID_72, $ID_73, $ID_74, $ID_75, $ID_76, $ID_77, $ID_78, $ID_79, $ID_80,
						$ID_81, $ID_82, $ID_83, $ID_84, $ID_85, $ID_86, $ID_87, $ID_88, $ID_89, $ID_90,
						$ID_91, $ID_92, $ID_93, $ID_94, $ID_95, $ID_96);
		foreach ($DB as $ID) {
			echo "|".$id;
			foreach ($ID as $name_array) {
				echo "~".$name_array;
				foreach ($name_array as $name) {
					if ($name == $block_name) {
						echo $block_name;
						return $ID;
					}
				}
			}
		} */
	public function search_array_by_value($array, $value) {
        $results = array();
        if (is_array($array)) {
            $found = array_search($value,$array);
            if ($found) {
                $results[] = $found;
            }
            foreach ($array as $subarray)
                $results = array_merge($results, Blocks::search_array_by_value($subarray, $value));
				echo $results;
        }
        return $results;
    }
}