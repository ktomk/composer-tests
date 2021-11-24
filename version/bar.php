<?php

namespace FooInc {
    class Bar
    {
        static function __callStatic($name, $arguments)
        {
            list($event) = $arguments + array(null);
            var_dump($event->getName());
        }

        static function ringEx()
        {
            $args = func_get_args();
            foreach ($args as $index => $arg) {
                printf("#%d: %s\n", $index, $type = gettype($arg));
                switch ($type) {
                    case "object":
                        printf("    %s\n", get_class($arg));
                        if ($arg instanceof \Composer\Script\Event) {
                            printf("    event name: %s\n", $arg->getName());
                            printf("    is dev mode: %d\n", $arg->isDevMode());
                        }
                        break;
                    default:
                        // fall-through
                }
                exit(0);
            }
        }
    }
}
