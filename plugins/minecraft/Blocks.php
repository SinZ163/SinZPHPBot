<?php
class Blocks {
	public function getID($name) {
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
		$ID_27 = array();
		$ID_28 = array();
		$ID_29 = array();
		$ID_30 = array();
		$ID_31 = array();
		$ID_32 = array();
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
		$ID_66 = array("Rail", "Rails", "Railway", "Track", "MinecartTrack", "CartTrack", "CartRail", "MinecartRail", "CartRails, "MinecartRails");
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
		$ID_91 = array("JackOLantern", "GlowingPumpkin", "Pumpkin", "Jack'O'Lantern);
		$ID_92 = array("Cake");
		$ID_93 = array("RedstoneRepeater");
		$ID_94 = array("RedstoneRepeater", "RedstoneRepeaterOn");
		$ID_95 = array();
		$ID_96 = array();
		array_push($DB, $ID_01, $ID_02, $ID_03, $ID_04, $ID_05, $ID_06, $ID_07, $ID_08, $ID_09, $ID_10,
						$ID_11, $ID_12, $ID_13, $ID_14, $ID_15, $ID_16, $ID_17, $ID_18, $ID_19, $ID_20,
						$ID_21, $ID_22, $ID_23, $ID_24, $ID_25, $ID_26, $ID_27, $ID_28, $ID_29, $ID_30,
						$ID_31, $ID_32, $ID_33, $ID_34, $ID_35, $ID_36, $ID_37, $ID_38, $ID_39, $ID_40,
						$ID_41, $ID_42, $ID_43, $ID_44, $ID_45, $ID_46, $ID_47, $ID_48, $ID_49, $ID_50,
						$ID_51, $ID_52, $ID_53, $ID_54, $ID_55, $ID_56, $ID_57, $ID_58, $ID_59, $ID_60,
						$ID_61, $ID_62, $ID_63, $ID_64, $ID_65, $ID_66, $ID_67, $ID_68, $ID_69, $ID_70,
						$ID_71, $ID_72, $ID_73, $ID_74, $ID_75, $ID_76, $ID_77, $ID_78, $ID_79, $ID_80,
						$ID_81, $ID_82, $ID_83, $ID_84, $ID_85, $ID_86, $ID_87, $ID_88, $ID_89, $ID_90,
						$ID_91, $ID_92, $ID_93, $ID_94, $ID_95, $ID_96, 
						$ID_256, $ID_257, $ID_258, $ID_259, $ID_260, 
						$ID_261, $ID_262, $ID_263, $ID_264, $ID_265, $ID_266, $ID_267, $ID_268, $ID_269, $ID_270,
						$ID_271, $ID_272, $ID_273, $ID_274, $ID_275, $ID_276, $ID_277, $ID_278, $ID_279, $ID_280,
						
		}
	}
}