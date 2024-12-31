<?php
declare(strict_types=1);

namespace alvin0319\AdvancedBan;

use Generator;
use poggit\libasynql\DataConnector;
use SOFe\AwaitGenerator\Await;

final class Database{
	public function __construct(private DataConnector $conn){ }
	public function banDevice(string $deviceId, int $expireAt, string $reason, string $issuer) : Generator{
		$this->conn->executeInsert("advancedban.ban_device", ["deviceId" => $deviceId, "expireAt" => $expireAt, "reason" => $reason, "issuer" => $issuer], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function banName(string $name, int $expireAt, string $reason, string $issuer) : Generator{
		$this->conn->executeInsert("advancedban.ban_name", ["name" => $name, "expireAt" => $expireAt, "reason" => $reason, "issuer" => $issuer], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function createSession(string $name, string $deviceIds) : Generator{
		$this->conn->executeInsert("advancedban.create_session", ["name" => $name, "deviceIds" => $deviceIds], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function getSession(string $name) : Generator{
		$this->conn->executeSelect("advancedban.get_session", ["name" => $name], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function initDeviceBan() : Generator{
		$this->conn->executeChange("advancedban.init_device_ban", [], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function initNameBan() : Generator{
		$this->conn->executeChange("advancedban.init_name_ban", [], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function initPlayer() : Generator{
		$this->conn->executeChange("advancedban.init_player", [], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function isBannedDevice(string $deviceId) : Generator{
		$this->conn->executeSelect("advancedban.is_banned_device", ["deviceId" => $deviceId], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function isBannedName(string $name) : Generator{
		$this->conn->executeSelect("advancedban.is_banned_name", ["name" => $name], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function pardonDevice(string $deviceId) : Generator{
		$this->conn->executeChange("advancedban.pardon_device", ["deviceId" => $deviceId], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function pardonName(string $name) : Generator{
		$this->conn->executeChange("advancedban.pardon_name", ["name" => $name], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
	public function updateSession(string $name, string $deviceIds) : Generator{
		$this->conn->executeChange("advancedban.update_session", ["name" => $name, "deviceIds" => $deviceIds], yield Await::RESOLVE, yield Await::REJECT);
		return yield Await::ONCE;
	}
}
