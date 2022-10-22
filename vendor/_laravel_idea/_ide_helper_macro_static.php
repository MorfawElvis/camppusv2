<?php //2172298cd201d3b5d23eb0f7880dfa91
/** @noinspection all */

namespace Illuminate\Contracts\View {

    /**
     * @method static $this extends($view, $params = [])
     * @method static $this layout($view, $params = [])
     * @method static $this layoutData($data = [])
     * @method static $this section($section)
     * @method static $this slot($slot)
     */
    class View {}
}

namespace Illuminate\Database\Eloquent {

    /**
     * @method static $this onlyTrashed(Builder $builder)
     * @method static int restore(Builder $builder)
     * @method static $this withTrashed(Builder $builder, $withTrashed = true)
     * @method static $this withoutTrashed(Builder $builder)
     */
    class Builder {}
}

namespace Illuminate\Http {

    /**
     * @method static bool hasValidRelativeSignature()
     * @method static bool hasValidSignature($absolute = true)
     * @method static bool hasValidSignatureWhileIgnoring($ignoreQuery = [], $absolute = true)
     * @method static array validate(array $rules, ...$params)
     * @method static void validateWithBag(string $errorBag, array $rules, ...$params)
     */
    class Request {}
}

namespace Illuminate\Support {

    /**
     * @method static $this debug()
     */
    class Collection {}
}

namespace Illuminate\Support\Facades {

    /**
     * @method static void auth($options = [])
     * @method static void confirmPassword()
     * @method static void emailVerification()
     * @method static void resetPassword()
     */
    class Route {}
}

namespace Illuminate\Testing {

    /**
     * @method static $this assertDontSeeLivewire($component)
     * @method static $this assertSeeLivewire($component)
     */
    class TestResponse {}

    /**
     * @method static $this assertDontSeeLivewire($component)
     * @method static $this assertSeeLivewire($component)
     */
    class TestView {}
}

namespace Illuminate\View {

    use Livewire\WireDirective;

    /**
     * @method static WireDirective wire($name)
     */
    class ComponentAttributeBag {}

    /**
     * @method static $this extends($view, $params = [])
     * @method static $this layout($view, $params = [])
     * @method static $this layoutData($data = [])
     * @method static $this section($section)
     * @method static $this slot($slot)
     */
    class View {}
}
